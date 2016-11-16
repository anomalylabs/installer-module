<?php namespace Anomaly\InstallerModule;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

/**
 * Class InstallerModuleServiceProvider
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class InstallerModuleServiceProvider extends AddonServiceProvider
{

    /**
     * The addon routes.
     *
     * @var array
     */
    protected $routes = [
        'installer'           => 'Anomaly\InstallerModule\Http\Controller\InstallerController@index',
        'installer/start'     => 'Anomaly\InstallerModule\Http\Controller\InstallerController@start',
        'installer/install'   => 'Anomaly\InstallerModule\Http\Controller\InstallerController@install',
        'installer/run/{key}' => 'Anomaly\InstallerModule\Http\Controller\InstallerController@run',
    ];
}
