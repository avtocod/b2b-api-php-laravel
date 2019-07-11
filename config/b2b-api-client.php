<?php

return [

    'report_types' => [
        'default'  => [
            'uid' => '%some_report_type_uid_here%',
        ],
        'extended' => [
            'uid' => '%one_more_report_type_uid%',
        ],
    ],

    'default_report_type' => 'default',

    'connections' => [
        'b2b-api-default' => [
            'endpoint'       => 'https://sdfsdfsdf.sdfsd/',
            'authorization'  => [
                'username' => 'foo',
                'password' => 'bar',
                'domain'   => 'baz',
                'token'    => 'BLAHBLAH==',
                'lifetime' => 172800, // Token lifetime (in seconds)
            ],
            'guzzle_options' => [],
        ],
    ],

    'default_connection' => 'b2b-api-default',

];
