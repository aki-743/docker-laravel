<?php
return [
    'paths' => [''],

    'allowed_methods' => ['GET', 'POST', 'PUT', 'OPTIONS'],

    'allowed_origins' => [env('CORS_ORIGIN_URL')],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['X-Requested-With', 'Content-Type', 'Origin', 'Cache-Control', 'Authorization', 'Accept', 'Accept-Encoding'],

    'exposed_headers' => ['Authorization'],

    'max_age' => 86400,

    'supports_credentials' => true,
];