<?php namespace Anomaly\InstallerModule\Form;

/**
 * Class InstallerFormFields
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\InstallerModule\Form
 */
class InstallerFormFields
{

    /**
     * Return the form fields.
     *
     * @param InstallerFormBuilder $builder
     */
    public function handle(InstallerFormBuilder $builder)
    {
        $builder->setFields(
            [
                /**
                 * License Fields
                 */
                'license'               => [
                    'label'        => 'anomaly.module.installer::field.license.label',
                    'instructions' => 'anomaly.module.installer::field.license.instructions',
                    'type'         => 'anomaly.field_type.boolean',
                    'wrapper_view' => 'anomaly.module.installer::field_type/license/wrapper',
                    'rules'        => [
                        'required',
                    ],
                    'config'       => [
                        'text'    => 'anomaly.module.installer::field.license.agree',
                        'type'    => 'checkbox',
                        'license' => function () {
                            return (new \Michelf\Markdown())->transform(
                                file_get_contents(app('streams.path') . '/LICENSE.md')
                            );
                        }
                    ],
                ],
                /**
                 * Database Fields
                 */
                'database_driver'       => [
                    'label'        => 'anomaly.module.installer::field.database_driver.label',
                    'instructions' => 'anomaly.module.installer::field.database_driver.instructions',
                    'type'         => 'anomaly.field_type.select',
                    'value'        => 'mysql',
                    'rules'        => [
                        'required',
                        'valid_database',
                    ],
                    'validators'   => [
                        'valid_database' => [
                            'handler' => 'Anomaly\InstallerModule\Form\Validation\ValidDatabase@validate',
                            'message' => 'anomaly.module.installer::message.database_error'
                        ]
                    ],
                    'config'       => [
                        'options' => [
                            'mysql'    => 'MySQL',
                            'postgres' => 'Postgres',
                            'sqlite'   => 'SQLite',
                            'sqlsrv'   => 'SQL Server',
                        ]
                    ],
                ],
                'database_host'         => [
                    'label'        => 'anomaly.module.installer::field.database_host.label',
                    'placeholder'  => 'anomaly.module.installer::field.database_host.placeholder',
                    'instructions' => 'anomaly.module.installer::field.database_host.instructions',
                    'type'         => 'anomaly.field_type.text',
                    'value'        => '127.0.0.1',
                    'rules'        => [
                        'required',
                    ],
                ],
                'database_name'         => [
                    'label'        => 'anomaly.module.installer::field.database_name.label',
                    'placeholder'  => 'anomaly.module.installer::field.database_name.placeholder',
                    'instructions' => 'anomaly.module.installer::field.database_name.instructions',
                    'type'         => 'anomaly.field_type.text',
                    'rules'        => [
                        'required',
                    ],
                ],
                'database_username'     => [
                    'label'        => 'anomaly.module.installer::field.database_username.label',
                    'placeholder'  => 'anomaly.module.installer::field.database_username.placeholder',
                    'instructions' => 'anomaly.module.installer::field.database_username.instructions',
                    'type'         => 'anomaly.field_type.text',
                    'value'        => 'root',
                    'rules'        => [
                        'required',
                    ],
                ],
                'database_password'     => [
                    'label'        => 'anomaly.module.installer::field.database_password.label',
                    'placeholder'  => 'anomaly.module.installer::field.database_password.placeholder',
                    'instructions' => 'anomaly.module.installer::field.database_password.instructions',
                    'type'         => 'anomaly.field_type.text',
                    'config'       => [
                        'type' => 'password',
                    ],
                ],
                /**
                 * Administrator Fields
                 */
                'admin_username'        => [
                    'label'        => 'anomaly.module.installer::field.admin_username.label',
                    'placeholder'  => 'anomaly.module.installer::field.admin_username.placeholder',
                    'instructions' => 'anomaly.module.installer::field.admin_username.instructions',
                    'type'         => 'anomaly.field_type.text',
                    'value'        => 'admin',
                    'rules'        => [
                        'required',
                    ],
                ],
                'admin_email'           => [
                    'label'        => 'anomaly.module.installer::field.admin_email.label',
                    'placeholder'  => 'anomaly.module.installer::field.admin_email.placeholder',
                    'instructions' => 'anomaly.module.installer::field.admin_email.instructions',
                    'type'         => 'anomaly.field_type.email',
                    'rules'        => [
                        'required',
                    ],
                ],
                'admin_password'        => [
                    'label'        => 'anomaly.module.installer::field.admin_password.label',
                    'placeholder'  => 'anomaly.module.installer::field.admin_password.placeholder',
                    'instructions' => 'anomaly.module.installer::field.admin_password.instructions',
                    'type'         => 'anomaly.field_type.text',
                    'rules'        => [
                        'required',
                    ],
                    'config'       => [
                        'type' => 'password',
                    ],
                ],
                /**
                 * Application Fields
                 */
                'application_name'      => [
                    'label'        => 'anomaly.module.installer::field.application_name.label',
                    'placeholder'  => 'anomaly.module.installer::field.application_name.placeholder',
                    'instructions' => 'anomaly.module.installer::field.application_name.instructions',
                    'type'         => 'anomaly.field_type.text',
                    'value'        => 'Default',
                    'rules'        => [
                        'required',
                    ],
                ],
                'application_reference' => [
                    'label'        => 'anomaly.module.installer::field.application_reference.label',
                    'placeholder'  => 'anomaly.module.installer::field.application_reference.placeholder',
                    'instructions' => 'anomaly.module.installer::field.application_reference.instructions',
                    'type'         => 'anomaly.field_type.slug',
                    'value'        => 'default',
                    'rules'        => [
                        'required',
                    ],
                ],
                'application_domain'    => [
                    'label'        => 'anomaly.module.installer::field.application_domain.label',
                    'placeholder'  => 'anomaly.module.installer::field.application_domain.placeholder',
                    'instructions' => 'anomaly.module.installer::field.application_domain.instructions',
                    'type'         => 'anomaly.field_type.text',
                    'value'        => str_replace(['http://', 'https://'], '', app('request')->root()),
                    'rules'        => [
                        'required',
                    ],
                ],
                'application_locale'    => [
                    'label'        => 'anomaly.module.installer::field.application_locale.label',
                    'instructions' => 'anomaly.module.installer::field.application_locale.instructions',
                    'type'         => 'anomaly.field_type.select',
                    'value'        => 'en',
                    'rules'        => [
                        'required',
                    ],
                    'config'       => [
                        'options' => function () {
                            return config('streams.available_locales');
                        }
                    ],
                ],
                'application_timezone'  => [
                    'label'        => 'anomaly.module.installer::field.application_timezone.label',
                    'instructions' => 'anomaly.module.installer::field.application_timezone.instructions',
                    'type'         => 'anomaly.field_type.select',
                    'value'        => 'UTC',
                    'rules'        => [
                        'required',
                    ],
                    'config'       => [
                        'options' => function () {

                            $options = [];

                            foreach (timezone_identifiers_list() as $timezone) {

                                $options[$timezone] = $timezone;
                            }

                            return $options;
                        }
                    ],
                ],
            ]
        );
    }
}
