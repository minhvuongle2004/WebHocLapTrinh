<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Auth\Events\Authenticated;
use App\Listeners\CheckDeviceAfterLogin;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin.auth' => \App\Http\Middleware\AdminAuth::class,
            'user.auth' => \App\Http\Middleware\UserAuth::class,
            'check.device' => \App\Http\Middleware\CheckDeviceMiddleware::class,
            'force.https' => \App\Http\Middleware\ForceHttps::class,
        ]);
        $middleware->prependToGroup('web', \App\Http\Middleware\ForceHttps::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();