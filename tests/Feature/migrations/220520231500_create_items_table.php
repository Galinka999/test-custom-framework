<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

use Engine\Db;
use Illuminate\Database\Capsule\Manager as Capsule;
use Symfony\Component\Dotenv\Dotenv;

$env = new Dotenv;
$env->load(__DIR__ . "/../../../.env.testing");
//
$db = new Db();

Capsule::schema()->create('items', function ($table) {
    $table->increments('id');
    $table->string('name', 255)->nullable();
    $table->string('phone', 15)->nullable();
    $table->string('key', 25);
    $table->timestamps();
});
