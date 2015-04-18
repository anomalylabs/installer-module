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
            'dom',
            'zip',
            'pdo',
            'curl',
            'json',
            'mcrypt',
            'filter',
            'mcrypt',
            'openssl',
            'mbstring',
            'fileinfo',
            'tokenizer'
        ];

        foreach ($extensions as $extension) {
            if (!extension_loaded($extension)) {
                die("The [{$extension}] PHP extension is required.");
            }
        }
    }
}
