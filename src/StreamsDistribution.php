<?php namespace Anomaly\InstallerModule;

use Anomaly\Streams\Platform\Addon\Module\Module;

/**
 * Class InstallerModule
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\InstallerModule
 */
class InstallerModule extends Module
{

    /**
     * The default standard theme.
     *
     * @var string
     */
    protected $standardTheme = 'anomaly.theme.streams';

    /**
     * The default admin theme.
     *
     * @var string
     */
    protected $adminTheme = 'anomaly.theme.streams';

}
