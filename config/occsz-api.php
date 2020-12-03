<?php

return [

    'accountName' =>  env('OCCSZ_ACCOUNT_NAME', 'demo'),

    'accounts' => [
        'demo' => [ 
            'userName' => env('OCCSZ_USER_NAME', 'demo'), 
            'password' => env('OCCSZ_PASSWORD', 'demo'),
            'isHttps' => env('OCCSZ_IS_HTTPS', 1),
            'partUrl' => env('OCCSZ_PART_URL', 'occsztest.e-cegjegyzek.hu')
        ]
    ]
];