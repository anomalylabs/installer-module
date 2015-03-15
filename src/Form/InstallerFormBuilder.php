<?php namespace Anomaly\InstallerModule\Form;

use Anomaly\InstallerModule\Form\Command\SetFormOptions;
use Anomaly\Streams\Platform\Ui\Form\Form;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class InstallerFormBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\InstallerModule\Form
 */
class InstallerFormBuilder extends FormBuilder
{

    /**
     * The form actions.
     *
     * @var array
     */
    protected $actions = [
        'save' => [
            'type'       => 'green',
            'text'       => 'anomaly.module.streams::button.install',
            'attributes' => [
                'data-toggle' => 'dimmer',
                'data-target' => '.installer.dimmer'
            ]
        ]
    ];

    /**
     * Create a new InstallerFormBuilder instance.
     *
     * @param Form $form
     */
    public function __construct(Form $form)
    {
        $this->dispatch(new SetFormOptions($form->getOptions()));

        parent::__construct($form);
    }
}
 
