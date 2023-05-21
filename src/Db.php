<?php

declare(strict_types=1);

namespace Engine;

use Illuminate\Database\Capsule\Manager as Capsule;
use Symfony\Component\Dotenv\Dotenv;

class Db
{
    public function __construct(string $testing = null)
    {
        $env = new Dotenv;
        $env->load(__DIR__ . "/../.env");

        $config = require_once __DIR__ . '/../configs/database.php';
        $config = $config['env'];

        $capsule = new Capsule;

        $capsule->addConnection([
            'driver' => $config['dev']['adapter'],
            'host' => $config['dev']['host'],
            'database' => $config['dev']['name'],
            'username' => $config['dev']['user'],
            'password' => $config['dev']['pass'],
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ], 'default');

        $capsule->addConnection([
            'driver' => $config['testing']['adapter'],
            'host' => $config['testing']['host'],
            'database' => $config['testing']['name'],
            'username' => $config['testing']['user'],
            'password' => $config['testing']['pass'],
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ], 'testing');

        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }
}