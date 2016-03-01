<?php

return [
    'license'               => [
        'label'        => 'Sind Sie mit den Bedingungen dieser Lizenz und den Bedingungen der Lizenzen aller enthaltenen Addons einverstanden?',
        'instructions' => 'Bitte beachten Sie, dass alle Addons eine separate Lizenz haben.'
    ],
    'database_driver'       => [
        'label'            => 'Treiber',
        'instructions'     => 'Welchen Datenbanktreiber möchten Sie benutzen?',
        'invalid_database' => 'Die Verbindung zur angegebenen Datenbank konnte nicht hergestellt werden.',
    ],
    'database_host'         => [
        'label'        => 'Host',
        'placeholder'  => 'localhost',
        'instructions' => 'Was ist der Hostname des Servers, auf dem Ihre Datenbank liegt?',
    ],
    'database_name'         => [
        'label'        => 'Datenbank',
        'placeholder'  => 'streams',
        'instructions' => 'Was ist der Name der Datenbank?',
    ],
    'database_username'     => [
        'label'        => 'Benutzername',
        'placeholder'  => 'root',
        'instructions' => 'Geben Sie den Benutzernamen der Datenbankverbindung ein.',
    ],
    'database_password'     => [
        'label'        => 'Passwort',
        'placeholder'  => 'Ihr sicheres Passwort',
        'instructions' => 'Geben Sie das Passwort der Datebankverbindung ein.',
    ],
    'admin_username'        => [
        'label'        => 'Benutzername',
        'placeholder'  => 'admin',
        'instructions' => 'Was ist der Benutzername des Website-Administrators?',
    ],
    'admin_email'           => [
        'label'        => 'E-Mail',
        'placeholder'  => 'beispiel@domain.de',
        'instructions' => 'Was ist die E-Mail-Adresse des Website-Administrators?',
    ],
    'admin_password'        => [
        'label'        => 'Passwort',
        'placeholder'  => 'Geben Sie ein sicheres Passwort ein',
        'instructions' => 'Was ist das Passwort des Website-Administrator?',
    ],
    'application_name'      => [
        'label'        => 'Name der Applikation / Website',
        'placeholder'  => 'Streams',
        'instructions' => 'Was ist der Name Ihrer Website bzw. Applikation?',
    ],
    'application_reference' => [
        'label'        => 'Referenz-Slug der Applikation',
        'placeholder'  => 'default',
        'instructions' => 'Bitten geben Sie den Referenz-Slug Ihrer Website bzw. Applikation an.', // @todo: check reference slug
    ],
    'application_domain'    => [
        'label'        => 'Primäre Domöne',
        'placeholder'  => 'localhost',
        'instructions' => 'Wie heisst die primäre Domäne Ihrer Website bzw. Applikation?',
    ],
    'application_locale'    => [
        'label'        => 'Sprache',
        'instructions' => 'Was ist die Standard-Sprache Ihrer Website bzw. Applikation?',
    ],
    'application_timezone'  => [
        'label'        => 'Zeitzone',
        'instructions' => 'Was ist die Standard-Zeitzone Ihrer Website bzw. Applikation?',
    ],
];