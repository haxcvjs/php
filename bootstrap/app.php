<?php

$app = new Core\App\Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);


$app->singleton(
    App\Http\Kernel::class, function() use ($app) {
        return new App\Http\Kernel($app, $app->get(Core\Router\Router::class) );
    });
return $app;

