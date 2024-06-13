<?php

namespace Core\Http\Middleware;

use Closure;

class HttpSecurity {

    public function handle($request, Closure $next, ...$guards)
    {
        
        return $next($request);
        
    }
}