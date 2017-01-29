<?php namespace Anomaly\InstallerModule\Installer\Command;

use Illuminate\Contracts\Config\Repository;
use PDO;

/**
 * Class CreateDatabase
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class CreateDatabase
{

    /**
     * Handle the command.
     *
     * @param Repository $config
     * @throws \Exception
     */
    public function handle(Repository $config)
    {
        $database = $config->get('database.connections.install');

        /**
         * Try creating a MySQL database.
         */
        if ($database['driver'] == 'mysql') {

            $connection = new PDO(
                "mysql:host=" . $database['host'],
                $database['username'],
                $database['password']
            );

            $connection->exec(
                "CREATE DATABASE `" . $database['database'] . "`;
                CREATE USER '" . $database['username'] . "'@'" . $database['host'] . "' IDENTIFIED BY '" . $database['password'] . "';
                GRANT ALL ON `" . $database['database'] . "`.* TO '" . $database['username'] . "@'" . $database['host'] . "';
                FLUSH PRIVILEGES;"
            );

            return;
        }

        throw new \Exception("Database does not exist and unable to create.");
    }
}
