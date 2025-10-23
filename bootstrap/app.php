<?php

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        commands: __DIR__.'/../routes/console.php',
        using: function (): void {
            Route::middleware('auth:sanctum')
            ->prefix('api/v1/admin')
            ->name('apiAdmin.')
            ->group(base_path('routes/apiAdmin.php'));

            Route::middleware('api')
            ->prefix('api/v1')
            ->name('api.')
            ->group(base_path('routes/api.php'));

            Route::middleware('api')
            ->prefix('api/v1/auth')
            ->name('apiAuth.')
            ->group(base_path('routes/apiAuth.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (AuthenticationException $e, Request $request) {
            return response()->json([
                'success' => false,
                'message' => 'No autenticado. Por favor inicia sesión.'
            ], 401);
        });
        $exceptions->render(function (ValidationException $e, Request $request) {
            return response()->json([
                'success' => false,
                'message' => 'Datos inválidos',
                'errors' => $e->errors(),
            ], 422);
        });
    })->create();
