<?php

return [
    'license'               => [
        'label'        => 'هل توافق على شروط هذا الترخيص ورخص كل الإضافات المحتواة?',
        'required'     => 'يجب الموافقة على شروط الترخيص قبل المتابعة.',
        'instructions' => 'الرجاء الملاحظة أن الوحدات مرخصة بشكل منفصل.',
        'agree'        => 'نعم, أوافق على هذه الشروط.',
    ],
    'database_driver'       => [
        'label'            => 'المشغل',
        'instructions'     => 'ماهو مشغل قاعدة البيانات الذي تستخدمه?',
        'invalid_database' => 'لا يمكن الاتصال بقاعدة البيانات المزودة.',
    ],
    'database_host'         => [
        'label'        => 'المضيف',
        'placeholder'  => 'localhost',
        'instructions' => 'ما هو اسم المضيف لقاعدة بياناتك?',
    ],
    'database_name'         => [
        'label'        => 'قاعدة البيانات',
        'placeholder'  => 'streams',
        'instructions' => 'ما هو اسم قاعدة البيانات?',
    ],
    'database_username'     => [
        'label'        => 'اسم المستخدم',
        'placeholder'  => 'root',
        'instructions' => 'ادخل اسم المستخدم لاتصال قاعدة البيانات.',
    ],
    'database_password'     => [
        'label'        => 'كلمة المرور',
        'placeholder'  => 'كلمة المرور الخاصة بك',
        'instructions' => 'ادخل كلمة المرور لاتصال قاعدة البيانات.',
    ],
    'admin_username'        => [
        'label'        => 'اسم المستخدم',
        'placeholder'  => 'admin',
        'instructions' => 'ماهو اسم المستخدم للمدير?',
    ],
    'admin_email'           => [
        'label'        => 'البريد الالكتروني',
        'placeholder'  => 'example@domain.com',
        'instructions' => 'ماهو البريد الالكتروني للمدير?',
    ],
    'admin_password'        => [
        'label'        => 'كلمة المرور',
        'placeholder'  => 'ادخل كلمة المرور',
        'instructions' => 'ما هي كلمة المرور للمدير?',
    ],
    'application_name'      => [
        'label'        => 'اسم التطبيق',
        'placeholder'  => 'Streams',
        'instructions' => 'ما هو اسم تطبيقك?',
    ],
    'application_reference' => [
        'label'        => 'إشار التطبيق',
        'placeholder'  => 'default',
        'instructions' => 'ما هو معرف المشير إلى تطبيقك?',
    ],
    'application_domain'    => [
        'label'        => 'النطاق الأساسي',
        'placeholder'  => 'localhost',
        'instructions' => 'ماهو النظاق الأساسي لتطبيقك?',
    ],
    'application_locale'    => [
        'label'        => 'اللغة',
        'instructions' => 'ما هي لغة تطبيقك الافتراضية?',
    ],
    'application_timezone'  => [
        'label'        => 'المنطقة الزمنية',
        'instructions' => 'ماهي المنظقة الزمنية الافتراضية لتطبيقك?',
    ],
];
