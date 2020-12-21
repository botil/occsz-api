<?php

return [

    'accountName' =>  env('OCCSZ_ACCOUNT_NAME', 'demo'),

    'accounts' => [
        'demo' => [
            'userName' => 'demo',
            'password' => 'demo',
            'isHttps' => 1,
            'partUrl' => 'occsztest.e-cegjegyzek.hu'
        ],
        'prod' => [
            'userName' => env('OCCSZ_USER_NAME', ''),
            'password' => env('OCCSZ_PASSWORD', ''),
            'isHttps' => env('OCCSZ_IS_HTTPS', 1),
            'partUrl' => env('OCCSZ_PART_URL', 'occsz.e-cegjegyzek.hu')
        ]
    ]
];
