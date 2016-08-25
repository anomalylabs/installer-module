<?php

return [
    'license'               => [
        'label'        => 'Do you agree to the terms of this license and the licenses of all contained add-ons?',
        'required'     => 'You must agree with the provided license(s) before proceeding.',
        'instructions' => 'Please note all addons are licensed separately.',
        'agree'        => 'Yes, I agree with these terms.',
    ],
    'database_driver'       => [
        'label'            => 'Driver',
        'instructions'     => 'What database driver would you like to use?',
        'invalid_database' => 'Could not connect to database provided.',
    ],
    'database_host'         => [
        'label'        => 'Host',
        'placeholder'  => 'localhost',
        'instructions' => 'What is the hostname of your database?',
    ],
    'database_name'         => [
        'label'        => 'Database',
        'placeholder'  => 'streams',
        'instructions' => 'What is the name of your database?',
    ],
    'database_username'     => [
        'label'        => 'Username',
        'placeholder'  => 'root',
        'instructions' => 'Enter the username for your database connection.',
    ],
    'database_password'     => [
        'label'        => 'Password',
        'placeholder'  => 'Your secure password',
        'instructions' => 'Enter the password for your database connection.',
    ],
    'admin_username'        => [
        'label'        => 'Username',
        'placeholder'  => 'admin',
        'instructions' => 'What is the administrator\'s username?',
    ],
    'admin_email'           => [
        'label'        => 'Email',
        'placeholder'  => 'example@domain.com',
        'instructions' => 'What is the administrator\'s email?',
    ],
    'admin_password'        => [
        'label'        => 'Password',
        'placeholder'  => 'Enter a secure password',
        'instructions' => 'What is the administrator\'s password?',
    ],
    'application_name'      => [
        'label'        => 'Application Name',
        'placeholder'  => 'Streams',
        'instructions' => 'What is the name of your application?',
    ],
    'application_reference' => [
        'label'        => 'Application Reference',
        'placeholder'  => 'default',
        'instructions' => 'What is the reference slug of your application?',
    ],
    'application_domain'    => [
        'label'        => 'Primary Domain',
        'placeholder'  => 'localhost',
        'instructions' => 'What is the primary domain of your application?',
    ],
    'application_locale'    => [
        'label'        => 'Language',
        'instructions' => 'What is the default language of your application?',
    ],
    'application_timezone'  => [
        'label'        => 'Timezone',
        'instructions' => 'What is the default timezone of your application?',
    ],
];