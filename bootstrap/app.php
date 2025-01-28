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
       // $middleware->web(append: \App\Http\Middleware\VerifyCsrfToken::class);
        //$middleware->api(append: \App\Http\Middleware\SubstituteBindings::class);
       // $middleware->validateCsrfTokens(except: ['stripe/*']);
        //$middleware->removeFromGroup("web", validateCsrfTokens::class);
          // Disable CSRF protection for specific routes
         /* $middleware->validateCsrfTokens(except: [
            '/api/upload-roster',
            'http://localhost:8000/',
            
        ]);*/
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
