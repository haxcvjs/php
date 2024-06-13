<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Auth\AccountController;
use Closure;
use Core\Tools\Session;

class LoginMiddleware
{

 
    public function handle($request, Closure $next, ...$guards)
    {
        
        
         if(app(AccountController::class)->isLoggedIn()) {
            redirect(route('dashboard.home'));
            return;
         }

        return $next($request);
    }
    
     
}
