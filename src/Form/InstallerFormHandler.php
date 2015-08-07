<?php namespace Anomaly\InstallerModule\Form;

use Anomaly\InstallerModule\InstallerModuleInstaller;

/**
 * Class InstallerFormHandler
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\InstallerModule\Form
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
 