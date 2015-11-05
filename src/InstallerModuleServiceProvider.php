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
        'installer'            => 'Anomaly\InstallerModule\Http\Controller\InstallerController@index',
        'installer/install'    => 'Anomaly\InstallerModule\Http\Controller\InstallerController@install',
        'installer/finish'     => 'Anomaly\InstallerModule\Http\Controller\InstallerController@finish',
        'installer/run/{key}'  => 'Anomaly\InstallerModule\Http\Controller\InstallerController@run',
        'installer/seed/{key}' => 'Anomaly\InstallerModule\Http\Controller\InstallerController@seed'
    ];
}
