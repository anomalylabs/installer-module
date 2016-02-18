<?php namespace Anomaly\InstallerModule\Installer\Form;

use Anomaly\InstallerModule\InstallerModuleInstaller;

/**
 * Class InstallerFormHandler
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\InstallerModule\Installer\Form
 */
class InstallerFormHandler
{

    /**
     * Handle the installer form.
     *
     * @param InstallerFormBuilder     $builder
     * @param InstallerModuleInstaller $moduleInstaller
     */
    public function handle(InstallerFormBuilder $builder, InstallerModuleInstaller $moduleInstaller)
    {
        if ($builder->hasFormErrors()) {
            return;
        }

        $moduleInstaller->install($_POST);

        $builder->setFormResponse(redirect('installer/install'));
    }
}
 