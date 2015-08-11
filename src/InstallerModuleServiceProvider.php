<?php namespace Anomaly\InstallerModule;

use Anomaly\InstallerModule\Command\CheckDirectoryPermissions;
use Anomaly\InstallerModule\Command\CheckPhpExtensions;
use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

/**
 * Class InstallerModuleServiceProvider
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\InstallerModule
 */
class InstallerModuleServiceProvider extends AddonServiceProvider
{

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->dispatch(new CheckPhpExtensions());
        $this->dispatch(new CheckDirectoryPermissions());

        parent::register();
    }

    /**
     * Only return routes if not installed.
     *
     * @return array
     */
    public function getRoutes()
    {
        if (env('INSTALLED')) {
            return [];
        } else {
            return [
                'installer'                       => 'Anomaly\InstallerModule\Http\Controller\InstallerController@index',
                'installer/install'               => 'Anomaly\InstallerModule\Http\Controller\InstallerController@install',
                'installer/complete'              => 'Anomaly\InstallerModule\Http\Controller\InstallerController@complete',
                'installer/command/{command}'     => 'Anomaly\InstallerModule\Http\Controller\InstallerController@command',
                'installer/module/{module}'       => 'Anomaly\InstallerModule\Http\Controller\InstallerController@module',
                'installer/seed/{module}'         => 'Anomaly\InstallerModule\Http\Controller\InstallerController@seed',
                'installer/extension/{extension}' => 'Anomaly\InstallerModule\Http\Controller\InstallerController@extension'
            ];
        }
    }
}
