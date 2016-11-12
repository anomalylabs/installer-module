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

        $this->dispatch(new LoadModuleSeeders($installers));
        $this->dispatch(new LoadExtensionSeeders($installers));

        $installers->add(
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

        $installers->add(
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
