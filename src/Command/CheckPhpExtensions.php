<?php namespace Anomaly\InstallerModule\Command;

use Illuminate\Contracts\Bus\SelfHandling;

/**
 * Class CheckPhpExtensions
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\InstallerModule\Command
 */
class CheckPhpExtensions implements SelfHandling
{

    /**
     * Handle the command.
     */
    public function handle()
    {
        $extensions = [
            'gd',
            'zip',
            'pdo',
            'curl',
            'mcrypt',
            'fileinfo'
        ];

        foreach ($extensions as $extension) {
            if (!extension_loaded($extension)) {
                die("The [{$extension}] PHP extension is required.");
            }
        }
    }
}
