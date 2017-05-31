<?php

return [
    'license'               => [
        'label'        => 'Egyetért az alkalmazás és az összes benne foglalt kiegészítés felhasználási feltételével?',
        'required'     => 'A folytatás előtt meg kell felelnie a megadott licenc(ek) nek.',
        'instructions' => 'Kérjük, vegye figyelembe, hogy az összes kiegészítés külön licenselve van.',
        'agree'        => 'Igen, elfogadom a felhasználási feltételeket.',
    ],
    'database_driver'       => [
        'label'            => 'Driver',
        'instructions'     => 'Milyen adatbázis drivert szeretnél használni?',
        'invalid_database' => 'Nem sikerült csatlakozni az adatbázishoz.',
    ],
    'database_host'         => [
        'label'        => 'Kiszolgáló (Host)',
        'placeholder'  => 'localhost',
        'instructions' => 'Mi az adatbázisod kiszolgálójának címe?',
    ],
    'database_name'         => [
        'label'        => 'Adatbázis',
        'placeholder'  => 'acesolution',
        'instructions' => 'Mi az adatbázisod neve?',
    ],
    'database_username'     => [
        'label'        => 'Felhasználónév',
        'placeholder'  => 'root',
        'instructions' => 'Írd be a felhasználónevet az adatbázis kapcsolathoz.',
    ],
    'database_password'     => [
        'label'        => 'Jelszó',
        'placeholder'  => 'A te titkos jelszavad',
        'instructions' => 'Írd be a jelszót az adatbázis kapcsolathoz.',
    ],
    'admin_username'        => [
        'label'        => 'Felhasználónév',
        'placeholder'  => 'admin',
        'instructions' => 'Mi legyen az adminisztrátor felhasználó neve?',
    ],
    'admin_email'           => [
        'label'        => 'Email',
        'placeholder'  => 'pelda@acesolution.hu',
        'instructions' => 'Mi legyen az adminisztrátor email címe?',
    ],
    'admin_password'        => [
        'label'        => 'Jelszó',
        'placeholder'  => 'Adj meg egy titkos jelszót',
        'instructions' => 'Mi legyen az adminisztrátor jelszava?',
    ],
    'application_name'      => [
        'label'        => 'Alkalmazás Neve',
        'placeholder'  => 'AceSolution',
        'instructions' => 'Mi legyen az alkalmazás neve?',
    ],
    'application_reference' => [
        'label'        => 'Alkalmazás Hivatkozása',
        'placeholder'  => 'acesolution',
        'instructions' => 'Mi legyen az alkalmazás azonosítója?',
    ],
    'application_domain'    => [
        'label'        => 'Elsődleges Domain',
        'placeholder'  => 'localhost',
        'instructions' => 'Mi legyen az alkalmazás elsődleges domain címe?',
    ],
    'application_locale'    => [
        'label'        => 'Nyelv',
        'instructions' => 'Mi legyen az alkalmazás alapértelmezett nyelve?',
    ],
    'application_timezone'  => [
        'label'        => 'Időzóna',
        'instructions' => '\'Mi legyen az alkalmazás alapértelmezett időzónája?',
    ],
];