<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        commands: __DIR__.'/../routes/console.php',
        using: function (): void {
            Route::middleware('api')
            ->prefix('api/v1/admin')
            ->name('apiAdmin.')
            ->group(base_path('routes/apiAdmin.php'));

            Route::middleware('api')
            ->prefix('api/v1')
            ->name('api.')
            ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        },
        /* health: '/up', */
        )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
