<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(\App\Http\Middleware\CheckSiteAccess::class);
        $middleware->append(\App\Http\Middleware\LogUserRequest::class);
        $middleware->append(\App\Http\Middleware\SetLocaleBySubdomain::class);
        $middleware->alias([
            'admin.auth' => \App\Http\Middleware\AdminApiAuth::class,
            'guest.admin' => \App\Http\Middleware\GuestAdmin::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

