<?php

return [
    'env' => [
        'dev' => [
            'adapter' => $_ENV['DB_CONNECTION'],
            'host' => $_ENV['DB_HOST'],
            'name' => $_ENV['DB_DATABASE'],
            'user' => $_ENV['DB_USERNAME'],
            'pass' => $_ENV['DB_PASSWORD'],
            'port' => $_ENV['DB_PORT'],
        ],
        'testing' => [
            'adapter' => 'pgsql',
            'host' => 'localhost',
            'name' => $_ENV['TEST_DB_DATABASE'],
            'user' => $_ENV['TEST_DB_USERNAME'],
            'pass' => $_ENV['TEST_DB_PASSWORD'],
            'port' => $_ENV['DB_PORT'],
        ]
    ]
];