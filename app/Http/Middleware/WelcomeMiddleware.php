<?php

namespace App\Http\Middleware;

use Closure;


class WelcomeMiddleware
{

 
    public function handle($request, Closure $next, ...$guards)
    {
        return $next($request);
        
    }
    
     
}
