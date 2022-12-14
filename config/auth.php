<?php

return [


    ////////// Defaults //////////

    'defaults' => [
        'guard' => 'DemonSlayers',
        'passwords' => 'DemonSlayers',
    ],


    ////////// Guards //////////

    'guards' => [
        'DemonSlayers' => [
            'driver' => 'session',
            'provider' => 'DemonSlayers'
        ],

        'Hashiras' => [
            'driver' => 'session',
            'provider' => 'Hashiras',
        ]      
    ],

    ////////// Providers //////////

    'providers' => [
        'DemonSlayers' => [
            'driver' => 'eloquent',
            'model' => App\Models\DemonSlayer::class,
        ],

        'Hashiras' => [
            'driver'=> 'eloquent',
            'model' => App\Models\Hashira::class
        ]
    ],

   ////////// Passwords //////////

    'passwords' => [
        'DemonSlayers' => [
            'provider' => 'DemonSlayers',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
        'Hashiras' => [
            'provider' => 'Hashiras',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ]
    ],

    'password_timeout' => 10800,

];
