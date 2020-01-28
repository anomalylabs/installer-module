<?php

namespace Anomaly\InstallerModule;

use Anomaly\Streams\Platform\Application\Command\ReadEnvironmentFile;
use Anomaly\Streams\Platform\Application\Command\WriteEnvironmentFile;
use Anomaly\Streams\Platform\Installer\Console\Command\SetStreamsData;
use Anomaly\Streams\Platform\Support\Collection;
use Anomaly\Streams\Platform\Support\Env;
use Illuminate\Support\Facades\Crypt;

/**
 * Class InstallerModuleInstaller
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class InstallerModuleInstaller
{


    /**
     * Install the system.
     *
     * @param  array $parameters
     * @return bool
     */
    public function install(array $parameters)
    {

        /**
         * If the .env file has not been generated yet then
         * generate it now and also generate an app key.
         */
        if (Env::generate()) {
            Env::load();
        }

        /**
         * Use the .env data as a basis
         * for the rest of the process.
         */
        $data = new Collection(Env::variables());

        Env::write('DEFAULT_LOCALE', $parameters['application_locale']);
        Env::write('DB_CONNECTION', $parameters['database_driver']);
        Env::write('DB_HOST', $parameters['database_host']);
        Env::write('DB_PORT', $parameters['database_port']);
        Env::write('DB_DATABASE', $parameters['database_name']);
        Env::write('DB_USERNAME', $parameters['database_username']);
        Env::write('DB_PASSWORD', '"' . $parameters['database_password'] . '"');
        Env::write('APP_REFERENCE', $parameters['application_reference']);
        Env::write('APP_NAME', '"' . $parameters['application_name'] . '"');
        Env::write('APP_TIMEZONE', $parameters['application_timezone']);
        Env::write('APP_URL', $parameters['application_domain']);
        Env::write('ADMIN_USERNAME', $parameters['admin_username']);
        Env::write('ADMIN_EMAIL', $parameters['admin_email']);
        Env::write('ADMIN_PASSWORD', $parameters['admin_password']);
    }
}
