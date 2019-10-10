<?php

namespace Anomaly\InstallerModule;

use Anomaly\InstallerModule\Http\Middleware\CheckIfInstallerExists;
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
     * The addon middleware.
     *
     * @var array
     */
    public $middleware = [
        CheckIfInstallerExists::class,
    ];

    /**
     * The addon routes.
     *
     * @var array
     */
    public $routes = [
        'installer'                => 'Anomaly\InstallerModule\Http\Controller\InstallerController@index',
        'installer/delete'         => 'Anomaly\InstallerModule\Http\Controller\InstallerController@delete',
        'installer/install'        => 'Anomaly\InstallerModule\Http\Controller\InstallerController@install',
        'installer/run/{key}'      => 'Anomaly\InstallerModule\Http\Controller\InstallerController@run',
        'installer/process/{key?}' => 'Anomaly\InstallerModule\Http\Controller\InstallerController@process',
    ];
}
