<?php namespace Anomaly\InstallerModule\Command;

use Anomaly\UsersModule\Role\Contract\RoleRepositoryInterface;
use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Anomaly\UsersModule\User\UserManager;
use Illuminate\Contracts\Bus\SelfHandling;

/**
 * Class CreateAdminRole
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\InstallerModule\Command
 */
class CreateAdminRole implements SelfHandling
{

    /**
     * Handle the command.
     *
     * @param RoleRepositoryInterface $roles
     * @param UserRepositoryInterface $users
     */
    public function handle(RoleRepositoryInterface $roles, UserRepositoryInterface $users)
    {
        $user = $users->findByUsername(env('ADMIN_USERNAME'));

        if (!$role = $roles->findBySlug('admin')) {
            $role = $roles->create(['en' => ['name' => 'Admin'], 'slug' => 'admin']);
        }

        $user->roles()->attach($role);
    }
}
