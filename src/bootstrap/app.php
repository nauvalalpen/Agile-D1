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
        $middleware->alias([
            'verified' => \App\Http\Middleware\EnsureEmailIsVerified::class,
            'socialite.errors' => \App\Http\Middleware\HandleSocialiteErrors::class,
            'account.ownership' => \App\Http\Middleware\VerifyAccountOwnership::class,
            'providers' => [PragmaRX\Google2FALaravel\ServiceProvider::class,],

            'aliases' => [
                // ... other aliases
                'Google2FA' => PragmaRX\Google2FALaravel\Facade::class,
            ],
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();