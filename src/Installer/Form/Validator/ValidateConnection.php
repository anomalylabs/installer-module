<?php namespace Anomaly\InstallerModule\Installer\Form\Validator;

use Anomaly\InstallerModule\Installer\Command\SetConnection;
use Anomaly\InstallerModule\Installer\Form\InstallerFormBuilder;

/**
 * Class ValidateConnection
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ValidateConnection
{

    /**
     * Handle the validation.
     *
     * @param  InstallerFormBuilder $builder
     * @return bool
     */
    public function handle(InstallerFormBuilder $builder)
    {
        dispatch_now(new SetConnection());

        try {
            app('db')->connection('install');
        } catch (\Exception $exception) {

            $builder->addFormError(
                'database_driver',
                trans(
                    'module::message.database_error',
                    [
                        'error' => $exception->getMessage(),
                    ]
                )
            );

            return false;
        }

        return true;
    }
}
