<?php

/** @var FastRoute\RouteCollector $router */

use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\ItemHistoryController;

$router->addRoute('GET', '/items', [ItemController::class, 'index']);
$router->addRoute('GET', '/items/{id:\d+}', [ItemController::class, 'show']);
$router->addRoute('POST', '/items', [ItemController::class,'save']);
$router->addRoute('PATCH', '/items/{id:\d+}', [ItemController::class, 'update']);
$router->addRoute('DELETE', '/items/{id:\d+}', [ItemController::class, 'delete']);

$router->addRoute('GET', '/items/{id:\d+}/history', [ItemHistoryController::class, 'index']);