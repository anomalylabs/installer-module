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
use App\Console\Kernel;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class InstallerController
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
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
     * @param Kernel $console
     * @return \Illuminate\View\View
     */
    public function install(Kernel $console)
    {
        $this->dispatch(new ReloadEnvironmentFile());
        $this->dispatch(new ConfigureDatabase());
        $this->dispatch(new SetDatabasePrefix());
        $this->dispatch(new LocateApplication());

        $installers = $this->dispatch(new GetInstallers());

        return view('anomaly.module.installer::install', compact('installers'));
    }

    /**
     * Finish installation.
     *
     * @param Kernel $console
     * @return \Illuminate\View\View
     */
    public function finish(Dispatcher $events)
    {
        $installers = new InstallerCollection();

        $events->fire(new StreamsHasInstalled($installers));

        return view('anomaly.module.installer::finish', compact('installers'));
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
 