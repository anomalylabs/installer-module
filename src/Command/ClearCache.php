<?php namespace Anomaly\InstallerModule\Command;

use App\Console\Kernel;
use Illuminate\Contracts\Bus\SelfHandling;

/**
 * Class ClearCache
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\InstallerModule\Command
 */
class ClearCache implements SelfHandling
{

    /**
     * Handle the command.
     *
     * @param Kernel $console
     */
    public function handle(Kernel $console)
    {
        $console->call('cache:clear');
    }
}
