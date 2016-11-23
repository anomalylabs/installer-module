<?php namespace Anomaly\InstallerModule\Installer\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class InstallerFormBuilder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class InstallerFormBuilder extends FormBuilder
{

    /**
     * The form sections.
     *
     * @var array
     */
    protected $sections = [
        'license'       => [
            'fields' => [
                'license',
            ],
        ],
        'database'      => [
            'fields' => [
                'database_driver',
                'database_host',
                'database_name',
                'database_username',
                'database_password',
            ],
        ],
        'administrator' => [
            'fields' => [
                'admin_username',
                'admin_email',
                'admin_password',
            ],
        ],
        'application'   => [
            'fields' => [
                'application_name',
                'application_reference',
                'application_domain',
                'application_locale',
                'application_timezone',
            ],
        ],
    ];

    /**
     * The form actions.
     *
     * @var array
     */
    protected $actions = [
        'install',
    ];
}
