<?php

use Illuminate\Http\Request;
use App\Http\Middleware\IpValidator;
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
        $middleware->alias([
            'ipCheck' => IpValidator::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (Throwable $exception, Request $request) {
            $defaultErrorStatus = [
                'status' => $exception->getStatusCode(),
                'description' => '[Handler] ' . $exception->getMessage()
            ];
            return response()->json($defaultErrorStatus, $exception->getStatusCode());
        });
    })->create();
