<?php

return [

    /**
     * Secret key
     */
    'secret' => env('KINOPOISK_SECRET'),

    /**
     * Guzzle HTTP Client options
     */
    'client'  => [
        'base_uri' => 'https://ext.kinopoisk.ru/ios/5.0.0/',
        'timeout'  => 5,
    ]
];
