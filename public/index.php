<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(0);

define('APP_START', microtime(true));
define('ABS_PATH', dirname(__DIR__));


require __DIR__.'/../vendor/autoload.php';


$app = require_once __DIR__.'/../bootstrap/app.php';



$kernel = $app->singleton(App\Http\Kernel::class);

$kernel->handle()->send();


$kernel->terminate();

