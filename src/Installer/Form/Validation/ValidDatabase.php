<?php namespace Anomaly\InstallerModule\Installer\Form\Validation;

/**
 * Class ValidDatabase
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\InstallerModule\Installer\Form
 */
class ValidDatabase
{

    /**
     * Validate the input.
     *
     * @return bool
     */
    public function validate()
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

            app('session')->flash(
                'warning',
                [trans('module::message.database_error', compact('error'))]
            );

            return false;
        }

        return true;
    }
}
