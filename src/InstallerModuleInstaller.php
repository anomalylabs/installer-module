<?php namespace Anomaly\InstallerModule;

use Anomaly\Streams\Platform\Application\Command\GenerateEnvironmentFile;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class InstallerModuleInstaller
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\InstallerModule
 */
class InstallerModuleInstaller
{

    use DispatchesJobs;

    /**
     * Install the system.
     *
     * @param array $parameters
     * @return bool
     */
    public function install(array $parameters)
    {
        $this->dispatch(
            new GenerateEnvironmentFile(
                [
                    'INSTALLED'             => 'false',
                    'APP_DEBUG'             => 'false',
                    'APP_ENV'               => 'local',
                    'APP_KEY'               => str_random(32),
                    'DB_DRIVER'             => $parameters['database_driver'],
                    'DB_HOST'               => $parameters['database_host'],
                    'DB_DATABASE'           => $parameters['database_name'],
                    'DB_USERNAME'           => $parameters['database_username'],
                    'DB_PASSWORD'           => $parameters['database_password'],
                    'APPLICATION_NAME'      => $parameters['application_name'],
                    'APPLICATION_DOMAIN'    => $parameters['application_domain'],
                    'APPLICATION_REFERENCE' => $parameters['application_reference'],
                    'CACHE_DRIVER'          => 'file', // @todo - add fields for this?
                    'SESSION_DRIVER'        => 'file', // @todo - add fields for this?
                    'ADMIN_THEME'           => config('streams::themes.admin.active'),
                    'STANDARD_THEME'        => config('streams::themes.standard.active'),
                    'LOCALE'                => $parameters['application_locale'],
                    'TIMEZONE'              => $parameters['application_timezone'],
                    'MAIL_DRIVER'           => 'mail',
                    'SMTP_HOST'             => null,
                    'SMTP_PORT'             => null,
                    'MAIL_FROM_ADDRESS'     => null,
                    'MAIL_FROM_NAME'        => null,
                    'SMTP_USERNAME'         => null,
                    'SMTP_PASSWORD'         => null,
                    'MAIL_DEBUG'            => false,
                    'ADMIN_USERNAME'        => $parameters['admin_username'],
                    'ADMIN_EMAIL'           => $parameters['admin_email'],
                    'ADMIN_PASSWORD'        => $parameters['admin_password'],
                    'SITE_ENABLED'          => true,
                    'IP_WHITELIST'          => null,
                    'FORCE_HTTPS'           => 'none'
                ]
            )
        );

        return true;
    }
}
