<?php namespace Anomaly\InstallerModule;

use Anomaly\InstallerModule\Command\GetEnvironmentVariables;
use Anomaly\InstallerModule\Command\RunMigrations;
use Anomaly\InstallerModule\Command\SetupApplication;
use Anomaly\Streams\Platform\Addon\Command\RegisterAddons;
use Anomaly\Streams\Platform\Addon\Extension\Command\InstallAllExtensions;
use Anomaly\Streams\Platform\Addon\Module\Command\InstallAllModules;
use Anomaly\Streams\Platform\Application\ApplicationModel;
use Anomaly\Streams\Platform\Application\Command\GenerateEnvironmentFile;
use Anomaly\Streams\Platform\Entry\Command\AutoloadEntryModels;
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
        $this->dispatch(new GenerateEnvironmentFile($this->dispatch(new GetEnvironmentVariables($parameters))));

        $this->dispatch(new SetupApplication($parameters));
        $this->dispatch(new RunMigrations());
        $this->dispatch(new InstallAllModules(true));
        $this->dispatch(new InstallAllExtensions(true));
        $this->dispatch(new AutoloadEntryModels());
        $this->dispatch(new RegisterAddons());

        $credentials = [
            'email'    => $parameters['admin_email'],
            'username' => $parameters['admin_username'],
            'password' => $parameters['admin_password']
        ];

        $user  = $this->users->create($credentials, true);
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

        $application->save();

        return true;
    }
}
