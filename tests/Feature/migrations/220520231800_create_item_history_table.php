<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Models\Item;
use Engine\Db;
use Illuminate\Database\Capsule\Manager as Capsule;
use Symfony\Component\Dotenv\Dotenv;

$env = new Dotenv;
$env->load(__DIR__ . "/../../../.env.testing");

$db = new Db();

if($_ENV['APP_ENV'] == 'local') {
    Capsule::schema('testing')->create('item_history', function ($table) {
        $table->increments('id');

        $table->foreignIdFor(Item::class)
            ->constrained()
            ->cascadeOnUpdate()
            ->cascadeOnDelete();

        $table->json('data');
        $table->timestamp('created_at');
    });
}

Capsule::schema()->create('item_history', function ($table) {
    $table->increments('id');

    $table->foreignIdFor(Item::class)
        ->constrained()
        ->cascadeOnUpdate()
        ->cascadeOnDelete();

    $table->json('data');
    $table->timestamp('created_at');
});