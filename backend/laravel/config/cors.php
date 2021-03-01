<?php
return [
    'paths' => ['*'],

    'allowed_methods' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],

    'allowed_origins' => [env('CORS_ORIGIN_URL')],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['X-Requested-With', 'Content-Type', 'Origin', 'Cache-Control', 'Authorization', 'Accept', 'Accept-Encoding'],

    'exposed_headers' => ['Authorization'],

    'max_age' => 0,

    'supports_credentials' => true,
];