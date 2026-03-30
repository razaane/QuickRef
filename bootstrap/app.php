<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Hna khass t-enregistrer l-aliases dyalk
        $middleware->alias([
            'arbitre' => \App\Http\Middleware\ArbitreMiddleware::class,
            'admin' => \App\Http\Middleware\AdminMiddleware::class, // Ila derti ta dial l-admin
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
