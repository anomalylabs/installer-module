<?php namespace Anomaly\InstallerModule\Command;

use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Anomaly\UsersModule\User\UserManager;
use Illuminate\Contracts\Bus\SelfHandling;

/**
 * Class CreateAdminUser
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\InstallerModule\Command
 */
class CreateAdminUser implements SelfHandling
{

    /**
     * Handle the command.
     *
     * @param UserManager $users
     */
    public function handle(UserManager $manager, UserRepositoryInterface $users)
    {
        $credentials = [
            'email'    => env('ADMIN_EMAIL'),
            'username' => env('ADMIN_USERNAME'),
            'password' => env('ADMIN_PASSWORD')
        ];

        if ($user = $users->findUserByUsername(env('ADMIN_USERNAME'))) {

            $user->email    = env('ADMIN_EMAIL');
            $user->password = env('ADMIN_PASSWORD');

            $user->save();
        } else {
            $manager->create($credentials, true);
        }
    }
}
