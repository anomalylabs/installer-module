<?php namespace Anomaly\InstallerModule\Command;

use Anomaly\Streams\Platform\Application\Command\GenerateEnvironmentFile;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdateEnvironmentFile
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\InstallerModule\Command
 */
class UpdateEnvironmentFile implements SelfHandling
{

    use DispatchesJobs;

    /**
     * Handle the command.
     */
    public function handle()
    {
        $data = [];

        foreach (file(base_path('.env'), FILE_IGNORE_NEW_LINES) as $line) {

            list($key, $value) = explode('=', $line);

            $data[$key] = $value;
        }

        $data['INSTALLED'] = 'true';

        $this->dispatch(new GenerateEnvironmentFile($data));
    }
}
