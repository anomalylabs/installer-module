<?php namespace Anomaly\InstallerModule\Command;

use Anomaly\Streams\Platform\Application\ApplicationRepository;
use Illuminate\Contracts\Bus\SelfHandling;

/**
 * Class CreateApplication
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\InstallerModule\Command
 */
class CreateApplication implements SelfHandling
{

    /**
     * Handle the command.
     *
     * @param ApplicationRepository $applications
     */
    public function handle(ApplicationRepository $applications)
    {
        if ($applications->findByDomain(env('APPLICATION_DOMAIN'))) {
            return;
        }

        $applications->create(
            [
                'name'      => env('APPLICATION_NAME'),
                'reference' => env('APPLICATION_REFERENCE'),
                'domain'    => env('APPLICATION_DOMAIN'),
                'enabled'   => true
            ]
        );
    }
}
