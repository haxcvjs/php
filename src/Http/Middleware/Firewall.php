<?php

namespace Core\Http\Middleware;

use Closure;
use Exception;

class Firewall {

    public function handle($request, Closure $next, ...$guards)
    {
        $server = strtolower($_SERVER['SERVER_SOFTWARE']);

        $secure = preg_match("/openssl/" , $server);
        $version = preg_match("/8.2/" , $server);
        try {

            
            if(!$secure) {
                throw new Exception(" Server is not Secured");
            }
            
            if(!$version) {
                throw new Exception(" Server is not valid version 8.2");
            }
        } catch(Exception $e) {
            print_r($e->getMessage());
            return;
        }
        
        
        return $next($request);
    }
}