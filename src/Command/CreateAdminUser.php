<?php namespace Anomaly\InstallerModule\Command;

use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Anomaly\UsersModule\User\UserActivator;
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

    public function handle(UserRepositoryInterface $users, UserActivator $activator)
    {
        $data = [
            'display_name' => 'Administrator',
            'email'        => env('ADMIN_EMAIL'),
            'username'     => env('ADMIN_USERNAME'),
            'password'     => env('ADMIN_PASSWORD')
        ];

        if ($user = $users->findByUsername(env('ADMIN_USERNAME'))) {

            $user->email    = env('ADMIN_EMAIL');
            $user->password = env('ADMIN_PASSWORD');

            $users->save($user);
        } else {
            $user = $users->create($data);
        }

        $activator->force($user);
    }
}
