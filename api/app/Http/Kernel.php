<?php

namespace App\Http;

//use Butler\Service\Http\Kernel as HttpKernel; 
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middlewareGroups = [
        'web' => [
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],    
        
        'api' => [
            'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
           
        ],
    ];
}
