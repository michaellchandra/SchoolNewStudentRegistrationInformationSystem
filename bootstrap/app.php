<?php

namespace App\Http;

use App\Http\Middleware\RoleMiddleware;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

class Kernel extends HttpKernel{
    protected $routeMiddleware = [

        'role' => \App\Http\Middleware\RoleMiddleware::class
    ];
}


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        
        $middleware->validateCsrfTokens(
            except: ['stripe/*']
        );
     
        // $middleware->web(append: [
        //     \App\Http\Middleware\RoleMiddleware::class,
        // ]);
        $middleware->alias([
            'role' => RoleMiddleware::class
        ]);
            
        
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

    
