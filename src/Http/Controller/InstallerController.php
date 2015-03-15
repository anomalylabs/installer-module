<?php namespace Anomaly\InstallerModule\Http\Controller;

use Anomaly\InstallerModule\Form\InstallerFormBuilder;
use Anomaly\Streams\Platform\Http\Controller\PublicController;

/**
 * Class InstallerController
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\InstallerModule\Http\Controller
 */
class InstallerController extends PublicController
{

    /**
     * Create a new InstallerController instance.
     *
     * @param InstallerFormBuilder $form
     * @return \Illuminate\View\View|\Symfony\Component\HttpFoundation\Response
     */
    public function index(InstallerFormBuilder $form)
    {
        return $form->render();
    }

    /**
     * Show the complete page.
     *
     * @return \Illuminate\View\View
     */
    public function complete()
    {
        return view('anomaly.module.installer::complete');
    }
}
 