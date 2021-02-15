<?php

namespace Anomaly\InstallerModule\Installer\Command;

use Anomaly\Streams\Platform\Console\Kernel;
use Anomaly\Streams\Platform\Installer\Installer;
use Anomaly\Streams\Platform\Installer\InstallerCollection;
use Anomaly\Streams\Platform\Application\ApplicationRepository;
use Anomaly\Streams\Platform\Entry\Command\AutoloadEntryModels;
use Anomaly\Streams\Platform\Application\Command\ReloadEnvironmentFile;
use Anomaly\Streams\Platform\Installer\Console\Command\LoadModuleSeeders;
use Anomaly\Streams\Platform\Installer\Console\Command\LoadBaseMigrations;
use Anomaly\Streams\Platform\Installer\Console\Command\LoadCoreInstallers;
use Anomaly\Streams\Platform\Installer\Console\Command\LoadExtensionSeeders;
use Anomaly\Streams\Platform\Installer\Console\Command\LoadModuleInstallers;
use Anomaly\Streams\Platform\Installer\Console\Command\LoadExtensionInstallers;
use Anomaly\Streams\Platform\Installer\Console\Command\LoadApplicationInstallers;

/**
 * Class GetInstallers
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class GetInstallers
{

    /**
     * Handle the command.
     *
     * @return InstallerCollection
     */
    public function handle()
    {
        $installers = new InstallerCollection();

        dispatch_now(new LoadCoreInstallers($installers));
        dispatch_now(new LoadApplicationInstallers($installers));

        dispatch_now(new LoadModuleInstallers($installers));
        dispatch_now(new LoadExtensionInstallers($installers));

        $installers->push(
            new Installer(
                'streams::installer.reloading_application',
                function (Kernel $console) {

                    $console->call('env:set', ['line' => 'INSTALLED=true']);

                    dispatch_now(new ReloadEnvironmentFile());
                    dispatch_now(new AutoloadEntryModels());
                }
            )
        );

        dispatch_now(new LoadBaseMigrations($installers));
        dispatch_now(new LoadModuleSeeders($installers));
        dispatch_now(new LoadExtensionSeeders($installers));

        $installers->push(
            new Installer(
                'streams::installer.running_seeds',
                function (ApplicationRepository $applications) {
                    $applications->create(
                        [
                            'name'      => env('APPLICATION_NAME'),
                            'reference' => env('APPLICATION_REFERENCE'),
                            'domain'    => env('APPLICATION_DOMAIN'),
                            'enabled'   => true,
                        ]
                    );
                }
            )
        );

        $installers->push(
            new Installer(
                'streams::installer.running_seeds',
                function (Kernel $console) {
                    $console->call('db:seed');
                }
            )
        );

        return $installers;
    }
}
