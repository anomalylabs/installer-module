<?php namespace Anomaly\InstallerModule\Installer\Form\Validator;

use Anomaly\InstallerModule\Installer\Form\InstallerFormBuilder;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Container\Container;
use Illuminate\Http\Request;

/**
 * Class DatabaseValidator
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class DatabaseValidator
{

    /**
     * Handle the validation.
     *
     * @param  Repository           $config
     * @param  Request              $request
     * @param  Container            $container
     * @param  InstallerFormBuilder $builder
     * @return bool
     */
    public function handle(Repository $config, Request $request, Container $container, InstallerFormBuilder $builder)
    {
        $input = $request->all();

        $config->set(
            'database.connections.install',
            [
                'driver'    => $input['database_driver'],
                'host'      => $input['database_host'],
                'database'  => $input['database_name'],
                'username'  => $input['database_username'],
                'password'  => $input['database_password'],
                'charset'   => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix'    => '',
            ]
        );

        try {

            $container
                ->make('db')
                ->connection('install');

        } catch (\Exception $e) {

            $error = $e->getMessage();

            $builder->addFormError('database_driver', trans('module::message.database_error', compact('error')));

            return false;
        }

        return true;
    }
}
