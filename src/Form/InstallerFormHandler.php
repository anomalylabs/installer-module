<?php namespace Anomaly\InstallerModule\Form;

use Anomaly\InstallerModule\InstallerModuleInstaller;
use Anomaly\Streams\Platform\Ui\Form\Form;

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
     * @param Form                     $form
     * @param InstallerModuleInstaller $moduleInstaller
     */
    public function handle(Form $form, InstallerModuleInstaller $moduleInstaller)
    {
        $moduleInstaller->install($_POST);

        $form->setResponse(redirect('installer/install'));
    }
}
 