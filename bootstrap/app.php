<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->api(prepend:[
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class
        ]);
        $middleware->alias([
            'check.session' => \App\Http\Middleware\CheckSessionActive::class,
            'role' => \App\Http\Middleware\RoleMiddleware::class,
            'office.ip' => \App\Http\Middleware\ValidateOfficeIp::class,
            'roleweb' => \App\Http\Middleware\RolewebMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->withSchedule(function($schedule){
        $schedule->command('app:clean-expired-sessions')->hourly();
    })->create();
