<?php namespace Anomaly\InstallerModule;

use Anomaly\InstallerModule\Command\SetupApplication;
use Anomaly\Streams\Platform\Application\ApplicationModel;
use Anomaly\Streams\Platform\Application\Command\GenerateEnvironmentFile;
use Anomaly\Streams\Platform\Stream\Command\CreateStreamsTables;
use Anomaly\UsersModule\Role\RoleManager;
use Anomaly\UsersModule\User\UserManager;
use Illuminate\Foundation\Bus\DispatchesCommands;

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

    use DispatchesCommands;

    /**
     * The role manager.
     *
     * @var RoleManager
     */
    protected $roles;

    /**
     * The user manager.
     *
     * @var UserManager
     */
    protected $users;

    /**
     * The application model.
     *
     * @var ApplicationModel
     */
    protected $applications;

    /**
     * Create a new InstallerModuleInstaller instance.
     *
     * @param RoleManager      $roles
     * @param UserManager      $users
     * @param ApplicationModel $applications
     */
    function __construct(RoleManager $roles, UserManager $users, ApplicationModel $applications)
    {
        $this->roles        = $roles;
        $this->users        = $users;
        $this->applications = $applications;
    }

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
                    'INSTALLED'         => 'false',
                    'APP_DEBUG'         => 'false',
                    'APP_KEY'           => str_random(32),
                    'DB_DRIVER'         => $parameters['database_driver'],
                    'DB_HOST'           => $parameters['database_host'],
                    'DB_DATABASE'       => $parameters['database_name'],
                    'DB_USERNAME'       => $parameters['database_username'],
                    'DB_PASSWORD'       => $parameters['database_password'],
                    'DEFAULT_REFERENCE' => $parameters['application_reference'],
                    'CACHE_DRIVER'      => 'file', // @todo - add fields for this?
                    'SESSION_DRIVER'    => 'file', // @todo - add fields for this?
                    'ADMIN_THEME'       => config('streams.admin_theme'),
                    'STANDARD_THEME'    => config('streams.standard_theme'),
                    'LOCALE'            => $parameters['application_locale'],
                    'TIMEZONE'          => $parameters['application_timezone'],
                    'MAIL_DRIVER'       => 'smtp',
                    'SMTP_HOST'         => 'smtp.mailgun.org',
                    'SMTP_PORT'         => 587,
                    'MAIL_FROM_ADDRESS' => null,
                    'MAIL_FROM_NAME'    => null,
                    'SMTP_USERNAME'     => null,
                    'SMTP_PASSWORD'     => null,
                    'MAIL_DEBUG'        => false,
                    'ADMIN_USERNAME'    => $parameters['admin_username'],
                    'ADMIN_EMAIL'       => $parameters['admin_email'],
                    'ADMIN_PASSWORD'    => $parameters['admin_password']
                ]
            )
        );

        /*
        $admin = $this->roles->create(
            [
                'en'   => [
                    'name' => 'Administrator'
                ],
                'slug' => 'admin'
            ]
        );

        $this->roles->create(
            [
                'en'   => [
                    'name' => 'User',
                ],
                'slug' => 'user'
            ]
        );

        $this->users->attachRole($user, $admin);

        $application = $this->applications->newInstance();

        $application->enabled   = true;
        $application->name      = array_get($parameters, 'application_name');
        $application->domain    = array_get($parameters, 'application_domain');
        $application->reference = array_get($parameters, 'application_reference');

        $application->save();*/

        return true;
    }
}
