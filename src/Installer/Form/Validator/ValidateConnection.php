<?php namespace Anomaly\InstallerModule\Installer\Form\Validator;

use Anomaly\InstallerModule\Installer\Command\SetConnection;
use Anomaly\InstallerModule\Installer\Form\InstallerFormBuilder;
use Illuminate\Contracts\Container\Container;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class ValidateConnection
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class ValidateConnection
{

    use DispatchesJobs;

    /**
     * Handle the validation.
     *
     * @param  Container            $container
     * @param  InstallerFormBuilder $builder
     * @return bool
     */
    public function handle(Container $container, InstallerFormBuilder $builder)
    {
        $this->dispatchSync(new SetConnection());

        try {

            $container
                ->make('db')
                ->connection('install');
        } catch (\Exception $e) {

            $builder->addFormError(
                'database_driver',
                trans(
                    'module::message.database_error',
                    [
                        'error' => $e->getMessage(),
                    ]
                )
            );

            return false;
        }

        return true;
    }
}
