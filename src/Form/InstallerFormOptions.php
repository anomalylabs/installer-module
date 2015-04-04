<?php namespace Anomaly\InstallerModule\Form;

/**
 * Class InstallerFormOptions
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\InstallerModule\Form
 */
class InstallerFormOptions
{

    /**
     * Handle the form options.
     *
     * @param InstallerFormBuilder $builder
     */
    public function handle(InstallerFormBuilder $builder)
    {
        $form = $builder->getForm();

        $form->setOption('layout_view', 'anomaly.module.installer::layouts/installer');
        $form->setOption('handler', 'Anomaly\InstallerModule\Form\InstallerFormHandler@handle');

        $form->setOption(
            'sections',
            [
                [
                    'fields' => [
                        'license',
                    ]
                ],
                [
                    'title'  => 'anomaly.module.installer::form.database',
                    'fields' => [
                        'database_driver',
                        'database_host',
                        'database_name',
                        'database_username',
                        'database_password',
                    ]
                ],
                [
                    'title'  => 'anomaly.module.installer::form.administrator',
                    'fields' => [
                        'admin_username',
                        'admin_email',
                        'admin_password',
                    ]
                ],
                [
                    'title'  => 'anomaly.module.installer::form.application',
                    'fields' => [
                        'application_name',
                        'application_reference',
                        'application_domain',
                        'application_locale',
                        'application_timezone',
                    ]
                ]
            ]
        );
    }
}
