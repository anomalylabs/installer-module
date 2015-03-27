<?php namespace Anomaly\InstallerModule;

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
     * The addon routes.
     *
     * @var array
     */
    protected $routes = [
        'installer'                       => 'Anomaly\InstallerModule\Http\Controller\InstallerController@index',
        'installer/progress'              => 'Anomaly\InstallerModule\Http\Controller\InstallerController@progress',
        'installer/complete'              => 'Anomaly\InstallerModule\Http\Controller\InstallerController@complete',
        'installer/command/{command}'     => 'Anomaly\InstallerModule\Http\Controller\InstallerController@command',
        'installer/module/{module}'       => 'Anomaly\InstallerModule\Http\Controller\InstallerController@module',
        'installer/seed/{module}'         => 'Anomaly\InstallerModule\Http\Controller\InstallerController@seed',
        'installer/extension/{extension}' => 'Anomaly\InstallerModule\Http\Controller\InstallerController@extension'
    ];

}
