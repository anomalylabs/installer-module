<?php

namespace Anomaly\InstallerModule\Installer\Form;

/**
 * Class InstallerFormOptions
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class InstallerFormOptions
{

    /**
     * Handle the command.
     *
     * @param InstallerFormBuilder $builder
     */
    public function handle(InstallerFormBuilder $builder)
    {
        $builder->setOptions(
            [
                'layout_view' => 'anomaly.module.installer::layouts/installer',
                'breadcrumb'  => 'anomaly.module.installer::breadcrumb.install',
            ]
        );
    }
}
