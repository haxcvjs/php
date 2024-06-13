<?php

namespace App\Http\Middleware;

use Closure;
use Exception;

class AuthMiddleware
{

 
    public function handle($request, Closure $next, ...$guards)
    {
        
 
        
        if(!verify_csrf_token($request->csrf_token)) {
            throw new Exception("invalid Authirazation CSRF Token is missing");
             return;
         }

        return $next($request);
    }
    
     
}
