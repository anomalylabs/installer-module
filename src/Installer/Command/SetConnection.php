<?php namespace Anomaly\InstallerModule\Installer\Command;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Http\Request;

/**
 * Class SetConnection
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SetConnection
{

    /**
     * Set the connection.
     *
     * @param Request    $request
     * @param Repository $config
     */
    public function handle(Request $request, Repository $config)
    {
        $config->set(
            'database.connections.install',
            [
                'driver'    => $request->get('database_driver'),
                'host'      => $request->get('database_host'),
                'database'  => $request->get('database_name'),
                'username'  => $request->get('database_username'),
                'password'  => $request->get('database_password'),
                'charset'   => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix'    => '',
            ]
        );
    }
}
