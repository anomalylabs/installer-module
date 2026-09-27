<?php

return [
    'database_driver'       => env('DB_CONNECTION', 'mysql'),
    'database_host'         => env('DB_HOST', 'localhost'),
    'database_port'         => env('DB_PORT', '3306'),
    'database_name'         => env('DB_DATABASE'),
    'database_username'     => env('DB_USERNAME', 'root'),
    'database_password'     => env('DB_PASSWORD'),
    'admin_username'        => env('ADMIN_USERNAME', 'admin'),
    'admin_email'           => env('ADMIN_EMAIL'),
    'application_name'      => env('APPLICATION_NAME', 'Default'),
    'application_reference' => env('APPLICATION_REFERENCE', 'default'),
    'application_domain'    => env('APPLICATION_DOMAIN'),
    'application_locale'    => env('DEFAULT_LOCALE', 'en'),
    'application_timezone'  => env('APP_TIMEZONE', 'UTC'),
];
