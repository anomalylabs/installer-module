<?php namespace Anomaly\InstallerModule\Http\Controller;

use Anomaly\InstallerModule\Installer\Command\GetInstallers;
use Anomaly\InstallerModule\Installer\Form\InstallerFormBuilder;
use Anomaly\InstallerModule\InstallerModuleInstaller;
use Anomaly\Streams\Platform\Application\Command\ReloadEnvironmentFile;
use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Anomaly\Streams\Platform\Installer\Console\Command\ConfigureDatabase;
use Anomaly\Streams\Platform\Installer\Console\Command\SetDatabasePrefix;
use Anomaly\Streams\Platform\Installer\Installer;
use Anomaly\Streams\Platform\Installer\InstallerCollection;
use Illuminate\Cache\CacheManager;
use Illuminate\Contracts\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class InstallerController
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class InstallerController extends PublicController
{

    use DispatchesJobs;

    /**
     * Create a new InstallerController instance.
     *
     * @param InstallerFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(InstallerFormBuilder $form)
    {
        return $form->render();
    }

    /**
     * Process the installers from a web request.
     *
     * @param InstallerModuleInstaller $installer
     * @param Container                $container
     * @param null                     $key
     * @return \Illuminate\Http\RedirectResponse
     */
    public function process(InstallerModuleInstaller $installer, Container $container, $key = null)
    {
        /* @var InstallerCollection $installers */
        $installers = $this->dispatchSync(new GetInstallers());

        // Output progress?
        $verbose = $this->request->get('verbose');

        /**
         * Start by writing the .env file.
         * Then redirect to the first installer.
         */
        if ($this->request->get('action') == 'install') {

            $installer->install($this->request->all());

            $this->dispatchSync(new ReloadEnvironmentFile());
            $this->dispatchSync(new ConfigureDatabase());
            $this->dispatchSync(new SetDatabasePrefix());

            $installer = $installers
                ->keys()
                ->first();

            return $this->redirect->to('installer/process/' . $installer . "?verbose=" . $verbose);
        }

        /**
         * Figure out how many, the current,
         * and next installer commands.
         */
        $total = $installers->count();
        $keys  = $installers->keys()->all();
        $count = array_search($key, $keys) + 1;
        $next  = array_get($keys, array_search($key, $keys) + 1);

        /* @var Installer $installer */
        $installer = $installers->get($key);

        if ($verbose) {

            ob_start();

            echo "{$count}/{$total} - " . trans($installer->getMessage()) . "<br><br>";

            ob_flush();
            flush();
        }

        $container->call($installer->getTask());

        if (!$next && $verbose) {
            return $this->redirect->to('admin/login');
        }

        if (!$next && !$verbose) {
            echo 'Done!';

            exit;
        }

        return $this->redirect->to('installer/process/' . $next . "?verbose=" . $verbose);
    }

    /**
     * Run installation.
     *
     * @param  CacheManager $cache
     * @return \Illuminate\View\View
     */
    public function install(CacheManager $cache)
    {
        $cache->store()->flush();

        $this->dispatchSync(new ReloadEnvironmentFile());
        $this->dispatchSync(new ConfigureDatabase());
        $this->dispatchSync(new SetDatabasePrefix());

        $installers = $this->dispatchSync(new GetInstallers());

        return $this->view->make('anomaly.module.installer::process', compact('installers'));
    }

    /**
     * Run an installation command.
     *
     * @param  Container $container
     * @param            $key
     * @return bool
     */
    public function run(Container $container, $key)
    {
        $installers = $this->dispatchSync(new GetInstallers());

        /* @var Installer $installer */
        $installer = $installers->get($key);

        $container->call($installer->getTask());

        return 'true';
    }

    /**
     * Delete the installer module.
     *
     * @param Filesystem $files
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Filesystem $files)
    {
        $json = file_get_contents(base_path('composer.json'));

        $pattern = '/,\s*("anomaly\/installer-module").*"/';

        $files->put(base_path('composer.json'), preg_replace($pattern, '', $json));

        $files->deleteDirectory(base_path('vendor/anomaly/installer-module'));

        return $this->redirect->back();
    }
}
