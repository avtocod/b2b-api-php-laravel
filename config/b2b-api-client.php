<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Report Type
    |--------------------------------------------------------------------------
    |
    | Report type name, that will be used by default.
    |
    */
    'default_report_type' => 'default',

    /*
    |--------------------------------------------------------------------------
    | Report Types Settings
    |--------------------------------------------------------------------------
    |
    | Declared here report types accessible using `RepositoryInterface`. You
    | must follows next declaration template:
    |
    | ```
    | 'name' => ['uid' => 'report_type_uid@gomain'],
    | ```
    |
    */
    'report_types'        => [

        'default' => [
            'uid' => env('B2B_API_REPORT_TYPE_UID', 'some_report_type_uid@domain'),
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Default B2B API Client
    |--------------------------------------------------------------------------
    |
    | Connection name, that will be used by default.
    |
    */
    'default_connection'  => 'default',

    /*
    |--------------------------------------------------------------------------
    | B2B API Clients Settings
    |--------------------------------------------------------------------------
    |
    | Key is connection name, and value is its configuration. Each
    | configuration allows to use:
    |
    | - `base_uri` (string|null) - Override default B2B API base URI (optional)
    | - `auth`     (array)       - Authorization settings
    |   - `token`    (string|null) - Ready auth token (any another auth
    |                                settings will be ignored)
    |   - `username` (string|null) - Username (login, *without* domain)
    |   - `password` (string|null) - User password
    |   - `domain`   (string|null) - User domain
    |   - `lifetime` (int|null)    - Token lifetime (in seconds, optional)
    | - `guzzle_options` (array|null) - Guzzle client options (optional)
    |                                   Docs: <http://docs.guzzlephp.org/en/latest/quickstart.html>
    |
    */
    'connections'         => [

        'default' => [
            'base_uri'       => env('B2B_API_BASE_URI', null),
            'auth'           => [
                'token'    => env('B2B_API_AUTH_TOKEN', null),
                'username' => env('B2B_API_AUTH_USERNAME', 'user'),
                'password' => env('B2B_API_AUTH_PASSWORD', 'pass'),
                'domain'   => env('B2B_API_AUTH_DOMAIN', 'domain'),
                'lifetime' => (int) env('B2B_API_TOKEN_LIFETIME', 3600),
            ],
            'guzzle_options' => [],
        ],

    ],

];
