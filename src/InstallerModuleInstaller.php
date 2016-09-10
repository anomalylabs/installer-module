<?php namespace Anomaly\InstallerModule;

use Anomaly\Streams\Platform\Application\Command\ReadEnvironmentFile;
use Anomaly\Streams\Platform\Application\Command\WriteEnvironmentFile;
use Anomaly\Streams\Platform\Installer\Console\Command\SetStreamsData;
use Anomaly\Streams\Platform\Support\Collection;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class InstallerModuleInstaller
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class InstallerModuleInstaller
{

    use DispatchesJobs;

    /**
     * Install the system.
     *
     * @param  array $parameters
     * @return bool
     */
    public function install(array $parameters)
    {
        $data = new Collection($this->dispatch(new ReadEnvironmentFile()));

        $this->dispatch(new SetStreamsData($data));

        $data->put('DB_CONNECTION', $parameters['database_driver']);
        $data->put('DB_HOST', $parameters['database_host']);
        $data->put('DB_DATABASE', $parameters['database_name']);
        $data->put('DB_USERNAME', $parameters['database_username']);
        $data->put('DB_PASSWORD', $parameters['database_password']);
        $data->put('APPLICATION_NAME', $parameters['application_name']);
        $data->put('APPLICATION_DOMAIN', $parameters['application_domain']);
        $data->put('APPLICATION_REFERENCE', $parameters['application_reference']);
        $data->put('DEFAULT_LOCALE', $parameters['application_locale']);
        $data->put('APP_TIMEZONE', $parameters['application_timezone']);
        $data->put('APP_URL', 'http://' . $parameters['application_domain']);
        $data->put('ADMIN_USERNAME', $parameters['admin_username']);
        $data->put('ADMIN_EMAIL', $parameters['admin_email']);
        $data->put('ADMIN_PASSWORD', $parameters['admin_password']);

        $this->dispatch(new WriteEnvironmentFile($data->all()));
    }
}
