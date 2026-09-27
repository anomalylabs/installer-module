<?php namespace Anomaly\InstallerModule\Installer\Command;

use Anomaly\Streams\Platform\Application\ApplicationRepository;
use Anomaly\Streams\Platform\Installer\Console\Command\LoadExtensionSeeders;
use Anomaly\Streams\Platform\Installer\Console\Command\LoadModuleSeeders;
use Anomaly\Streams\Platform\Installer\Installer;
use Anomaly\Streams\Platform\Installer\InstallerCollection;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class GetSeeders
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class GetSeeders
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

        $this->dispatchSync(new LoadModuleSeeders($installers));
        $this->dispatchSync(new LoadExtensionSeeders($installers));

        $installers->push(
            new Installer(
                'streams::installer.running_seeds',
                function (ApplicationRepository $applications) {
                    $applications->create(
                        [
                            'name'      => config('anomaly.module.installer::installer.application_name'),
                            'reference' => config('anomaly.module.installer::installer.application_reference'),
                            'domain'    => config('anomaly.module.installer::installer.application_domain'),
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
