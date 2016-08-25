<?php namespace Anomaly\InstallerModule\Installer\Command;

use Anomaly\Streams\Platform\Installer\Console\Command\LoadApplicationInstallers;
use Anomaly\Streams\Platform\Installer\Console\Command\LoadCoreInstallers;
use Anomaly\Streams\Platform\Installer\Console\Command\LoadExtensionInstallers;
use Anomaly\Streams\Platform\Installer\Console\Command\LoadModuleInstallers;
use Anomaly\Streams\Platform\Installer\Installer;
use Anomaly\Streams\Platform\Installer\InstallerCollection;
use App\Console\Kernel;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class GetInstallers
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class GetInstallers
{

    use DispatchesJobs;

    /**
     * Handle the command.
     *
     * @return InstallerCollection
     */
    public function handle()
    {
        $installers = new InstallerCollection();

        $this->dispatch(new LoadCoreInstallers($installers));
        $this->dispatch(new LoadApplicationInstallers($installers));

        $this->dispatch(new LoadModuleInstallers($installers));
        $this->dispatch(new LoadExtensionInstallers($installers));

        $installers->add(
            new Installer(
                'Updating environment file.',
                function (Kernel $console) {
                    $console->call('env:set', ['line' => 'INSTALLED=true']);
                }
            )
        );

        $installers->add(
            new Installer(
                'streams::installer.running_migrations',
                function (Kernel $console) {
                    $console->call('migrate', ['--force' => true, '--no-addons' => true]);
                }
            )
        );

        return $installers;
    }
}
