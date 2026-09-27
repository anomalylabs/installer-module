<?php namespace Anomaly\InstallerModule\Installer\Form;

use Anomaly\InstallerModule\Installer\Form\Validator\ValidateConnection;
use Anomaly\InstallerModule\Installer\Form\Validator\ValidateDatabase;
use Anomaly\InstallerModule\Installer\Form\Validator\ValidateDomain;

/**
 * Class InstallerFormFields
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
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
        $parts    = explode('.', request()->getHost());
        $lengths  = array_map('strlen', $parts);
        $database = $parts[array_search(max($lengths), $lengths)];

        $builder->setFields(
            [
                /*
                 * License Fields
                 */
                'license'               => [
                    'label'        => 'anomaly.module.installer::field.license.label',
                    'instructions' => 'anomaly.module.installer::field.license.instructions',
                    'wrapper_view' => 'anomaly.module.installer::field_type/license/wrapper',
                    'type'         => 'anomaly.field_type.boolean',
                    'required'     => true,
                    'config'       => [
                        'label'   => 'anomaly.module.installer::field.license.agree',
                        'mode'    => 'checkbox',
                        'license' => function () {
                            return (new \Parsedown())->parse(
                                file_get_contents(base_path('LICENSE.md'))
                            );
                        },
                    ],
                ],
                /*
                 * Database Fields
                 */
                'database_driver'       => [
                    'label'        => 'anomaly.module.installer::field.database_driver.label',
                    'instructions' => 'anomaly.module.installer::field.database_driver.instructions',
                    'type'         => 'anomaly.field_type.select',
                    'value'        => config('anomaly.module.installer::installer.database_driver'),
                    'required'     => true,
                    'rules'        => [
                        'valid_connection',
                        'valid_database',
                    ],
                    'validators'   => [
                        'valid_connection' => [
                            'handler' => ValidateConnection::class,
                            'message' => false,
                        ],
                        'valid_database'   => [
                            'handler' => ValidateDatabase::class,
                            'message' => false,
                        ],
                    ],
                    'config'       => [
                        'options' => [
                            'mysql'  => 'MySQL',
                            'pgsql'  => 'Postgres',
                            'sqlsrv' => 'SQL Server',
                        ],
                    ],
                ],
                'database_host'         => [
                    'label'        => 'anomaly.module.installer::field.database_host.label',
                    'placeholder'  => 'anomaly.module.installer::field.database_host.placeholder',
                    'instructions' => 'anomaly.module.installer::field.database_host.instructions',
                    'type'         => 'anomaly.field_type.text',
                    'value'        => config('anomaly.module.installer::installer.database_host'),
                    'required'     => true,
                ],
                'database_port'         => [
                    'label'        => 'anomaly.module.installer::field.database_port.label',
                    'placeholder'  => 'anomaly.module.installer::field.database_port.placeholder',
                    'instructions' => 'anomaly.module.installer::field.database_port.instructions',
                    'type'         => 'anomaly.field_type.text',
                    'value'        => config('anomaly.module.installer::installer.database_port'),
                    'required'     => true,
                ],
                'database_name'         => [
                    'label'        => 'anomaly.module.installer::field.database_name.label',
                    'placeholder'  => 'anomaly.module.installer::field.database_name.placeholder',
                    'instructions' => 'anomaly.module.installer::field.database_name.instructions',
                    'value'        => config('anomaly.module.installer::installer.database_name') ?: $database,
                    'type'         => 'anomaly.field_type.text',
                    'required'     => true,
                ],
                'database_username'     => [
                    'label'        => 'anomaly.module.installer::field.database_username.label',
                    'placeholder'  => 'anomaly.module.installer::field.database_username.placeholder',
                    'instructions' => 'anomaly.module.installer::field.database_username.instructions',
                    'value'        => config('anomaly.module.installer::installer.database_username'),
                    'type'         => 'anomaly.field_type.text',
                    'required'     => true,
                ],
                'database_password'     => [
                    'label'        => 'anomaly.module.installer::field.database_password.label',
                    'placeholder'  => 'anomaly.module.installer::field.database_password.placeholder',
                    'instructions' => 'anomaly.module.installer::field.database_password.instructions',
                    'type'         => 'anomaly.field_type.text',
                    'value'        => config('anomaly.module.installer::installer.database_password'),
                    'config'       => [
                        'type' => 'password',
                    ],
                ],
                /*
                 * Administrator Fields
                 */
                'admin_username'        => [
                    'label'        => 'anomaly.module.installer::field.admin_username.label',
                    'placeholder'  => 'anomaly.module.installer::field.admin_username.placeholder',
                    'instructions' => 'anomaly.module.installer::field.admin_username.instructions',
                    'value'        => config('anomaly.module.installer::installer.admin_username'),
                    'type'         => 'anomaly.field_type.text',
                    'required'     => true,
                ],
                'admin_email'           => [
                    'label'        => 'anomaly.module.installer::field.admin_email.label',
                    'placeholder'  => 'anomaly.module.installer::field.admin_email.placeholder',
                    'instructions' => 'anomaly.module.installer::field.admin_email.instructions',
                    'type'         => 'anomaly.field_type.email',
                    'value'        => config('anomaly.module.installer::installer.admin_email'),
                    'required'     => true,
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
                /*
                 * Application Fields
                 */
                'application_name'      => [
                    'label'        => 'anomaly.module.installer::field.application_name.label',
                    'placeholder'  => 'anomaly.module.installer::field.application_name.placeholder',
                    'instructions' => 'anomaly.module.installer::field.application_name.instructions',
                    'type'         => 'anomaly.field_type.text',
                    'value'        => config('anomaly.module.installer::installer.application_name'),
                    'required'     => true,
                ],
                'application_reference' => [
                    'label'        => 'anomaly.module.installer::field.application_reference.label',
                    'placeholder'  => 'anomaly.module.installer::field.application_reference.placeholder',
                    'instructions' => 'anomaly.module.installer::field.application_reference.instructions',
                    'type'         => 'anomaly.field_type.slug',
                    'value'        => config('anomaly.module.installer::installer.application_reference'),
                    'required'     => true,
                    'config'       => [
                        'slugify' => 'application_name',
                        'max'     => 15,
                    ],
                ],
                'application_domain'    => [
                    'label'        => 'anomaly.module.installer::field.application_domain.label',
                    'placeholder'  => 'anomaly.module.installer::field.application_domain.placeholder',
                    'instructions' => 'anomaly.module.installer::field.application_domain.instructions',
                    'type'         => 'anomaly.field_type.text',
                    'value'        => config('anomaly.module.installer::installer.application_domain') ?: str_replace(
                        ['http://', 'https://'],
                        '',
                        app('request')->root()
                    ),
                    'required'     => true,
                    'rules'        => [
                        'valid_domain',
                    ],
                    'validators'   => [
                        'valid_domain' => [
                            'handler' => ValidateDomain::class,
                            'message' => 'streams::validation.invalid',
                        ],
                    ],
                ],
                'application_locale'    => [
                    'label'        => 'anomaly.module.installer::field.application_locale.label',
                    'instructions' => 'anomaly.module.installer::field.application_locale.instructions',
                    'type'         => 'anomaly.field_type.language',
                    'value'        => config('anomaly.module.installer::installer.application_locale'),
                    'required'     => true,
                    'config'       => [
                        'mode'              => 'search',
                        'supported_locales' => true,
                    ],
                ],
                'application_timezone'  => [
                    'label'        => 'anomaly.module.installer::field.application_timezone.label',
                    'instructions' => 'anomaly.module.installer::field.application_timezone.instructions',
                    'type'         => 'anomaly.field_type.select',
                    'value'        => config('anomaly.module.installer::installer.application_timezone'),
                    'required'     => true,
                    'config'       => [
                        'mode'    => 'search',
                        'options' => join("\n", timezone_identifiers_list()),
                    ],
                ],
            ]
        );
    }
}
