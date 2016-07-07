<?php namespace Anomaly\InstallerModule\Installer\Form\Validator;

use Log;

/**
 * Class DatabaseValidator
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\InstallerModule\Installer\Form\Validator
 */
class DatabaseValidator
{

    /**
     * Handle the validation.
     *
     * @return bool
     */
    public function handle()
    {
        $input = app('request')->all();

        app('config')->set(
            'database.connections.install',
            [
                'driver'    => $input['database_driver'],
                'host'      => $input['database_host'],
                'database'  => $input['database_name'],
                'username'  => $input['database_username'],
                'password'  => $input['database_password'],
                'charset'   => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix'    => ''
            ]
        );

        try {
            app('db')->connection('install');
        } catch (\Exception $e) {

            $error = $e->getMessage();
            
            logger($error);

            return false;
        }

        return true;
    }
}
