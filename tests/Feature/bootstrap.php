<?php

use Engine\Db;
use Symfony\Component\Dotenv\Dotenv;

require_once __DIR__ . '/../../vendor/autoload.php';

$env = new Dotenv;
$env->load(__DIR__ . "/../../.env.testing");

$db = new Db();
