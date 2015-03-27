<?php namespace Anomaly\InstallerModule\Command;

use Anomaly\UsersModule\Role\Contract\RoleRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;

/**
 * Class CreateUserRole
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\InstallerModule\Command
 */
class CreateUserRole implements SelfHandling
{

    /**
     * Handle the command.
     *
     * @param RoleRepositoryInterface $roles
     */
    public function handle(RoleRepositoryInterface $roles)
    {
        if (!$roles->findBySlug('user')) {
            $roles->create(['en' => ['name' => 'User'], 'slug' => 'user']);
        }
    }
}
