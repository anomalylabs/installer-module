<?php namespace Anomaly\InstallerModule\Command;

use Anomaly\Streams\Platform\Addon\Module\ModuleManager;
use App\Console\Kernel;
use Illuminate\Contracts\Bus\SelfHandling;

/**
 * Class InstallBaseTables
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\InstallerModule\Command
 */
class InstallBaseTables implements SelfHandling
{

    /**
     * Handle the command.
     *
     * @param ModuleManager $manager
     */
    public function handle(Kernel $kernel)
    {
        $kernel->call(
            'migrate',
            ['--force' => true, '--no-addons' => true, '--path' => 'vendor/anomaly/streams-platform/migrations']
        );
        $kernel->call('migrate', ['--force' => true, '--no-addons' => true]);
    }
}
