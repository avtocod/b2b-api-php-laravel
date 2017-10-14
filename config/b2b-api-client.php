<?php

return [

    /*
     * URI сервиса B2B API.
     */
    'api_base_uri' => 'https://b2bapi.avtocod.ru/b2b/api/v1',

    /*
     * Домен пользователя.
     */
    'domain'       => env('B2B_API_CLIENT_DOMAIN', '%set_your_domain_here%'),

    /*
     * Имя пользователя.
     */
    'username'     => env('B2B_API_CLIENT_USERNAME', '%set_your_username_here%'),

    /*
     * Пароль пользователя.
     */
    'password'     => env('B2B_API_CLIENT_PASSWORD', '%set_your_password_here%'),

    /*
     * Типы отчетов.
     */
    'report_types' => [

        /*
         * UID-ы типов отчетов в формате '%короткое_имя%' => ['uid' => '%uid_ипа_отчета%', 'uid' => '%его_описание%']
         */
        'uids'           => [
            'default'  => [
                'uid'         => '%some_report_type_uid_here%',
                'description' => 'Some report type description',
            ],
            'extended' => [
                'uid'         => '%one_more_report_type_uid%',
                'description' => 'One more report type description',
            ],
        ],

        /*
         * Тип отчета, используемый по умолчанию. Должен присутствовать в ключах массиве 'uids'
         */
        'use_as_default' => env('B2B_API_DEFAULT_REPORT_TYPE', 'default'),

    ],

    'is_test' => (bool) env('B2B_API_IS_TEST', false),

];
