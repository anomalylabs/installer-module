<?php namespace Anomaly\InstallerModule\Installer\Command;

use Illuminate\Contracts\Container\Container;
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
     * @param Container $container
     * @return bool|Connection
     */
    public function handle(Container $container)
    {
        try {
            return $container
                ->make('db')
                ->connection('install');
        } catch (\Exception $e) {
            return false;
        }
    }
}
