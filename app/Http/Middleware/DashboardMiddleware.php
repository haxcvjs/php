<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Auth\AccountController;
use Closure;
use Core\Tools\Session;

class DashboardMiddleware
{

 
    public function handle($request, Closure $next, ...$guards)
    {
        
        if(!app(AccountController::class)->isLoggedIn()) {

            redirect(route('auth.login'));  
            return;
        }

         


        return $next($request);
    }
    
     
}
