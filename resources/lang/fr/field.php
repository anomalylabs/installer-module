<?php

return [
    'license'               => [
        'label'        => 'Acceptez-vous sans conditions les termes et la licence de tous les add-ons ?',
        'instructions' => "Remarque : tous les add-ons n'ont pas la même licence."
    ],
    'database_driver'       => [
        'label'            => 'Type de base de données',
        'instructions'     => 'Quel type de base de données souhaitez-vous utiliser ?',
        'invalid_database' => 'Impossible de se connecter à la base de données sélectionnée.',
    ],
    'database_host'         => [
        'label'        => 'Hôte',
        'placeholder'  => 'localhost',
        'instructions' => "Quel est le nom d'hôte de la base de données ?",
    ],
    'database_name'         => [
        'label'        => 'Base de données',
        'placeholder'  => 'streams',
        'instructions' => 'Quel est le nom de la base de données ?',
    ],
    'database_username'     => [
        'label'        => "Nom d'utilisateur",
        'placeholder'  => 'root',
        'instructions' => "Entrez le nom d'utilisateur de la base de données.",
    ],
    'database_password'     => [
        'label'        => 'Mot de passe',
        'placeholder'  => "Le mot de passe d'accès à la base de données.",
        'instructions' => "Entrez votre mot de passe pour vous connecter.",
    ],
    'admin_username'        => [
        'label'        => "Nom d'utilisateur",
        'placeholder'  => 'admin',
        'instructions' => "Quel est le nom d'utilisateur de l'administrateur ?",
    ],
    'admin_email'           => [
        'label'        => 'Email',
        'placeholder'  => 'exemple@domaine.fr',
        'instructions' => "Quel est l'adresse email de l'administrateur ?",
    ],
    'admin_password'        => [
        'label'        => 'Mot de passe',
        'placeholder'  => 'Votre mot de passe sécurisé',
        'instructions' => "Quel est le mot de passe de l'administrateur ?",
    ],
    'application_name'      => [
        'label'        => "Nom de l'application",
        'placeholder'  => 'Streams',
        'instructions' => "Quel est le nom de votre application ?",
    ],
    'application_reference' => [
        'label'        => "Référence de l'application",
        'placeholder'  => 'default',
        'instructions' => 'Quel est le slug du nom de votre application ?',
    ],
    'application_domain'    => [
        'label'        => 'Domaine principal',
        'placeholder'  => 'localhost',
        'instructions' => "Quel est le nom de domaine principal de votre application ?",
    ],
    'application_locale'    => [
        'label'        => 'Langage',
        'instructions' => "Quel est la langue par défaut de votre application ?",
    ],
    'application_timezone'  => [
        'label'        => 'Fuseau horaire',
        'instructions' => "Quel est le fuseau horaire de votre application ?",
    ],
];