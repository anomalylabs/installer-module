<?php namespace Anomaly\InstallerModule\Installer\Listener;

use Anomaly\Streams\Platform\Application\Command\ReadEnvironmentFile;
use Anomaly\Streams\Platform\Application\Command\WriteEnvironmentFile;
use Anomaly\Streams\Platform\Installer\Event\StreamsHasInstalled;
use Anomaly\Streams\Platform\Installer\Installer;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class CleanUp
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\InstallerModule\Installer\Listener
 */
class CleanUp
{

    use DispatchesJobs;

    /**
     * Handle the command.
     *
     * @param StreamsHasInstalled $event
     */
    public function handle(StreamsHasInstalled $event)
    {
        $installers = $event->getInstallers();

        $installers->add(
            new Installer(
                'anomaly.module.installer::install.cleaning_up',
                function () {

                    $data = $this->dispatch(new ReadEnvironmentFile());

                    array_pull($data, 'ADMIN_EMAIL');
                    array_pull($data, 'ADMIN_PASSWORD');

                    $this->dispatch(new WriteEnvironmentFile($data));
                }
            )
        );
    }
}
