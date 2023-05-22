<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Models\Item;
use Engine\Db;
use Illuminate\Database\Capsule\Manager as Capsule;
use Symfony\Component\Dotenv\Dotenv;

$env = new Dotenv;
$env->load(__DIR__ . "/../../.env");

$db = new Db();

Capsule::schema()->create('item_history', function ($table) {
    $table->increments('id');

    $table->foreignIdFor(Item::class)
        ->constrained()
        ->cascadeOnUpdate()
        ->cascadeOnDelete();

    $table->json('data');
    $table->timestamp('created_at');
});