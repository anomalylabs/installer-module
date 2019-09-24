<?php namespace Anomaly\InstallerModule\Installer\Command;

use Illuminate\Database\Connection;

/**
 * Class GetConnection
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class GetConnection
{

    /**
     * Handle the command.
     *
     * @return bool|Connection
     */
    public function handle()
    {
        try {
            return app('db')->connection('install');
        } catch (\Exception $e) {
            return false;
        }
    }
}
