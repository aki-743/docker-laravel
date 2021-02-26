<?php
return [
  'paths' => ['*'],

    'allowed_methods' => ['*'],

    'allowed_origins' => [env('CORS_ORIGIN_URL')],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,
];