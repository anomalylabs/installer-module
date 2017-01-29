<?php namespace Anomaly\InstallerModule\Installer\Form\Validator;

use Anomaly\InstallerModule\Installer\Command\CreateDatabase;
use Anomaly\InstallerModule\Installer\Command\GetConnection;
use Anomaly\InstallerModule\Installer\Form\InstallerFormBuilder;
use Illuminate\Database\Connection;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class ValidateDatabase
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class ValidateDatabase
{

    use DispatchesJobs;

    /**
     * Handle the validation.
     *
     * @param  InstallerFormBuilder $builder
     * @return bool
     */
    public function handle(InstallerFormBuilder $builder)
    {
        /* @var Connection $connection */
        if (!$connection = $this->dispatch(new GetConnection())) {
            return false;
        }

        try {

            /**
             * Check if the database exists.
             */
            $connection
                ->getDoctrineSchemaManager()
                ->listTableNames();
        } catch (\Exception $e) {

            /**
             * If not then try creating
             * the database exists.
             */
            try {
                $this->dispatch(new CreateDatabase());
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
        }

        return true;
    }
}
