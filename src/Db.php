<?php

declare(strict_types=1);

namespace Engine;

use Illuminate\Database\Capsule\Manager as Capsule;
use Symfony\Component\Dotenv\Dotenv;

class Db
{
    public function __construct()
    {
        $config = require_once __DIR__ . '/../configs/database.php';

        $capsule = new Capsule;

        $capsule->addConnection([
            'driver' => $config['adapter'],
            'host' => $config['host'],
            'database' => $config['name'],
            'username' => $config['user'],
            'password' => $config['pass'],
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ]);

        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }
}