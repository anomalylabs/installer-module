<?php namespace Anomaly\InstallerModule\Http\Controller;

use Anomaly\InstallerModule\Installer\Command\GetInstallers;
use Anomaly\InstallerModule\Installer\Form\InstallerFormBuilder;
use Anomaly\Streams\Platform\Application\Command\ReloadEnvironmentFile;
use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Anomaly\Streams\Platform\Installer\Console\Command\ConfigureDatabase;
use Anomaly\Streams\Platform\Installer\Console\Command\LocateApplication;
use Anomaly\Streams\Platform\Installer\Console\Command\SetDatabasePrefix;
use Anomaly\Streams\Platform\Installer\Event\StreamsHasInstalled;
use Anomaly\Streams\Platform\Installer\Installer;
use Anomaly\Streams\Platform\Installer\InstallerCollection;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class InstallerController
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\InstallerModule\Http\Controller
 */
class InstallerController extends PublicController
{

    use DispatchesJobs;

    /**
     * Create a new InstallerController instance.
     *
     * @param InstallerFormBuilder $form
     * @return \Illuminate\View\View|\Symfony\Component\HttpFoundation\Response
     */
    public function index(InstallerFormBuilder $form)
    {
        return $form->render();
    }

    /**
     * Run installation.
     *
     * @return \Illuminate\View\View
     */
    public function install()
    {
        $this->dispatch(new ReloadEnvironmentFile());
        $this->dispatch(new ConfigureDatabase());
        $this->dispatch(new SetDatabasePrefix());
        $this->dispatch(new LocateApplication());

        $action = 'install';

        $installers = $this->dispatch(new GetInstallers());

        return view('anomaly.module.installer::process', compact('action', 'installers'));
    }

    /**
     * Finish installation.
     *
     * @param Dispatcher $events
     * @return \Illuminate\View\View
     */
    public function finish(Dispatcher $events)
    {
        $action = 'finish';

        $installers = new InstallerCollection();

        $events->fire(new StreamsHasInstalled($installers));

        return view('anomaly.module.installer::process', compact('action', 'installers'));
    }

    /**
     * Run an installation command.
     *
     * @param Container  $container
     * @param            $key
     * @return bool
     */
    public function run(Container $container, $key)
    {
        $installers = $this->dispatch(new GetInstallers());

        /* @var Installer $installer */
        $installer = $installers->get($key);

        $container->call($installer->getTask());

        return 'true';
    }

    /**
     * Run an installation command.
     *
     * @param Container  $container
     * @param Dispatcher $events
     * @param            $key
     * @return bool
     */
    public function seed(Container $container, Dispatcher $events, $key)
    {
        $installers = new InstallerCollection();

        $events->fire(new StreamsHasInstalled($installers));

        /* @var Installer $installer */
        $installer = $installers->get($key);

        $container->call($installer->getTask());

        return 'true';
    }
}
 