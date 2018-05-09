<?php namespace Anomaly\InstallerModule\Installer\Form;

use Anomaly\InstallerModule\InstallerModuleInstaller;

/**
 * Class InstallerFormHandler
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class InstallerFormHandler
{

    /**
     * Handle the installer form.
     *
     * @param InstallerFormBuilder     $builder
     * @param InstallerModuleInstaller $moduleInstaller
     */
    public function handle(Request $request, InstallerFormBuilder $builder, InstallerModuleInstaller $moduleInstaller)
    {
        if ($builder->hasFormErrors()) {
            return;
        }

        $moduleInstaller->install($request->post());

        $builder->setFormResponse(redirect('installer/install'));
    }
}
 