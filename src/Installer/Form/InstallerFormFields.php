<?php namespace Anomaly\InstallerModule\Installer\Form;

use Anomaly\InstallerModule\Installer\Form\Validator\DatabaseValidator;
use Anomaly\InstallerModule\Installer\Form\Validator\DomainValidator;

/**
 * Class InstallerFormFields
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\InstallerModule\Installer\Form
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
                    'wrapper_view' => 'anomaly.module.installer::field_type/license/wrapper',
                    'messages'     => [
                        'required' => 'anomaly.module.installer::field.license.required'
                    ],
                    'type'         => 'anomaly.field_type.boolean',
                    'required'     => true,
                    'config'       => [
                        'checkbox_label' => 'anomaly.module.installer::field.license.agree',
                        'mode'           => 'checkbox',
                        'license'        => function () {
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
                    'value'        => env('DB_DRIVER', 'mysql'),
                    'required'     => true,
                    'rules'        => [
                        'valid_database',
                    ],
                    'validators'   => [
                        'valid_database' => [
                            'handler' => DatabaseValidator::class,
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
                    'value'        => 'localhost',
                    'required'     => true
                ],
                'database_name'         => [
                    'label'        => 'anomaly.module.installer::field.database_name.label',
                    'placeholder'  => 'anomaly.module.installer::field.database_name.placeholder',
                    'instructions' => 'anomaly.module.installer::field.database_name.instructions',
                    'value'        => env('DB_DATABASE', snake_case(strtolower(config('streams::distribution.name')))),
                    'type'         => 'anomaly.field_type.text',
                    'required'     => true
                ],
                'database_username'     => [
                    'label'        => 'anomaly.module.installer::field.database_username.label',
                    'placeholder'  => 'anomaly.module.installer::field.database_username.placeholder',
                    'instructions' => 'anomaly.module.installer::field.database_username.instructions',
                    'value'        => env('DB_USERNAME', 'root'),
                    'type'         => 'anomaly.field_type.text',
                    'required'     => true
                ],
                'database_password'     => [
                    'label'        => 'anomaly.module.installer::field.database_password.label',
                    'placeholder'  => 'anomaly.module.installer::field.database_password.placeholder',
                    'instructions' => 'anomaly.module.installer::field.database_password.instructions',
                    'type'         => 'anomaly.field_type.text',
                    'value'        => env('DB_PASSWORD'),
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
                    'value'        => env('ADMIN_USERNAME', 'admin'),
                    'type'         => 'anomaly.field_type.text',
                    'required'     => true
                ],
                'admin_email'           => [
                    'label'        => 'anomaly.module.installer::field.admin_email.label',
                    'placeholder'  => 'anomaly.module.installer::field.admin_email.placeholder',
                    'instructions' => 'anomaly.module.installer::field.admin_email.instructions',
                    'type'         => 'anomaly.field_type.email',
                    'value'        => env('ADMIN_EMAIL'),
                    'required'     => true
                ],
                'admin_password'        => [
                    'label'        => 'anomaly.module.installer::field.admin_password.label',
                    'placeholder'  => 'anomaly.module.installer::field.admin_password.placeholder',
                    'instructions' => 'anomaly.module.installer::field.admin_password.instructions',
                    'type'         => 'anomaly.field_type.text',
                    'required'     => true,
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
                    'value'        => env('APPLICATION_NAME', 'Default'),
                    'required'     => true
                ],
                'application_reference' => [
                    'label'        => 'anomaly.module.installer::field.application_reference.label',
                    'placeholder'  => 'anomaly.module.installer::field.application_reference.placeholder',
                    'instructions' => 'anomaly.module.installer::field.application_reference.instructions',
                    'type'         => 'anomaly.field_type.slug',
                    'value'        => env('APPLICATION_REFERENCE', 'default'),
                    'required'     => true,
                    'config'       => [
                        'slugify' => 'application_name'
                    ]
                ],
                'application_domain'    => [
                    'label'        => 'anomaly.module.installer::field.application_domain.label',
                    'placeholder'  => 'anomaly.module.installer::field.application_domain.placeholder',
                    'instructions' => 'anomaly.module.installer::field.application_domain.instructions',
                    'type'         => 'anomaly.field_type.text',
                    'value'        => env(
                        'APPLICATION_DOMAIN',
                        str_replace(['http://', 'https://'], '', app('request')->root())
                    ),
                    'required'     => true,
                    'rules'        => [
                        'valid_domain'
                    ],
                    'validators'   => [
                        'valid_domain' => [
                            'handler' => DomainValidator::class,
                            'message' => 'streams::validation.invalid'
                        ]
                    ]
                ],
                'application_locale'    => [
                    'label'        => 'anomaly.module.installer::field.application_locale.label',
                    'instructions' => 'anomaly.module.installer::field.application_locale.instructions',
                    'type'         => 'anomaly.field_type.language',
                    'value'        => env('LOCALE', 'en'),
                    'required'     => true,
                    'config'       => [
                        'supported_locales' => true
                    ],
                ],
                'application_timezone'  => [
                    'label'        => 'anomaly.module.installer::field.application_timezone.label',
                    'instructions' => 'anomaly.module.installer::field.application_timezone.instructions',
                    'type'         => 'anomaly.field_type.select',
                    'value'        => env('APP_TIMEZONE', 'UTC'),
                    'required'     => true,
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
