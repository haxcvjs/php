<?php

use Core\Container\Container;
use Core\Facades\DB;
use Core\Facades\Route;
use Core\Http\Response;
use Core\View\View;

function build_values ( $list = array() ) {
    $esses      = array_fill( 0, count( $list ), "'%s'" );
    return vsprintf( "(" . implode( ',', $esses ) . ')' , $list);
}

function build_keys ( $list = array(), $b='%s' ) {
    $esses      = array_fill( 0, count( $list ), $b );
    return vsprintf( "(" . implode( ',', $esses ) . ')' , $list);
}

function build_query_keys ( $list = array() ) {
     
    return build_keys($list);
}

function build_query_values ( $list = array() ) {
     
    return build_values($list);
}


function system_log_attemps( $csrf_attack ) {
    has_csrf_session();
    if( empty( $_SESSION[$csrf_attack] )) {
        $_SESSION[$csrf_attack] = 1;
    } else {
        $_SESSION[$csrf_attack] += 1;
    }
    return $_SESSION[$csrf_attack];
}

function csrf_destroy( $csrf_token=false ) {
    has_csrf_session();
    if( !empty( $_SESSION['csrf_token'] )) {
        $_SESSION['csrf_token'] = false;
    }
}

function verify_csrf_token( $csrf_token='null' ) {
    has_csrf_session();
    return hash_equals( (string) $_SESSION['csrf_token'] , (string) $csrf_token );
}

function has_csrf_session() {
    if(!isset($_SESSION) ) {
        session_start();
    }
}


function generate_csrf() {
    has_csrf_session();
    if (empty($_SESSION['csrf_token'])) {
        if (function_exists('mcrypt_create_iv')) {
            $_SESSION['csrf_token'] = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
        } else {
            $_SESSION['csrf_token'] = bin2hex(openssl_random_pseudo_bytes(32));
        }
    }
     
    return  $_SESSION['csrf_token'];
}




function generate_hash($len=32)
{
    if (function_exists('mcrypt_create_iv')) {
        return bin2hex(mcrypt_create_iv($len, MCRYPT_DEV_URANDOM));
    } else {
        return bin2hex(openssl_random_pseudo_bytes($len));
    }
}

function generate_random($len=32)
{
    return (
        base64_encode(
            md5(
                sha1(
                    md5(
                        sha1(
                            generate_hash($len)
                        )
                    )
                )
            )
        )
    );
}

function pwd_hash($pwd=false)
{
    return (
        md5(
            sha1(
                md5(
                    sha1(
                        $pwd
                    )
                )
            )
        )
    );
}


if (! function_exists('app')) {
    /**
     * Get the available container instance.
     *
     * @param  string|null  $abstract
     * @param  array  $parameters
     * @return mixed|\Illuminate\Contracts\Foundation\Application
     */
    function app($abstract = null, array $parameters = [])
    {
        if (is_null($abstract)) {
            return Container::getInstance();
        }

        return Container::getInstance()->make($abstract, $parameters);
    }
}


if (! function_exists('route')) {
    /**
     * Get the available container instance.
     *
     * @param  string|null  $abstract
     * @param  array  $parameters
     * @return mixed|\Illuminate\Contracts\Foundation\Application
     */
    function route($name='')
    {
        $route =  Route::getRoute($name);
        if(!$route) {
            throw new Exception(" Route {$name} not Found ");
        }

        return $route;
         
    }
}

if (! function_exists('view')) {
    /**
     * Get the available container instance.
     *  ِء
     * @param  string|null  $abstract
     * @param  array  $parameters
     * @return mixed|\Illuminate\Contracts\Foundation\Application
     */
    function view($filename, $data=[])
    {
        return app(View::class)->render($filename , $data);
         
    }
}

if (! function_exists('currency')) {
    /**
     * Get the available container instance.
     *
     * @param  string|null  $abstract
     * @param  array  $parameters
     * @return mixed|\Illuminate\Contracts\Foundation\Application
     */
    function currency($key='')
    {
        
        return app('app.system')['currency'];
         
    }
}

if (! function_exists('currencySymbol')) {
    /**
     * Get the available container instance.
     *
     * @param  string|null  $abstract
     * @param  array  $parameters
     * @return mixed|\Illuminate\Contracts\Foundation\Application
     */
    function currencySymbol($key='')
    {
        
        return '₮';//app('app.system')['currency_symbol'];
         
    }
}

if (! function_exists('__')) {
    /**
     * Get the available container instance.
     *
     * @param  string|null  $abstract
     * @param  array  $parameters
     * @return mixed|\Illuminate\Contracts\Foundation\Application
     */
    function __($key='')
    {
        
        return $key;
         
    }
}

if (! function_exists('isAjax')) {
    /**
     * Get the available container instance.
     *
     * @param  string|null  $abstract
     * @param  array  $parameters
     * @return mixed|\Illuminate\Contracts\Foundation\Application
     */
    function isAjax()
    {
        if(!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) return;
        if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === strtolower('XMLHttpRequest')) return true;     
         
    }
}

if (! function_exists('create_links')) {
    /**
     * Get the available container instance.
     *
     * @param  string|null  $abstract
     * @param  array  $parameters
     * @return mixed|\Illuminate\Contracts\Foundation\Application
     */
    function create_links()
    {
        
        return app('current.links');
         
    }
}

if (! function_exists('response')) {
    /**
     * Get the available container instance.
     *
     * @param  string|null  $abstract
     * @param  array  $parameters
     * @return mixed|\Illuminate\Contracts\Foundation\Application
     */
    function response()
    {
        
        return app()->get(Response::class);
         
    }
}

if (! function_exists('redirect')) {
    /**
     * Get the available container instance.
     *
     * @param  string|null  $abstract
     * @param  array  $parameters
     * @return mixed|\Illuminate\Contracts\Foundation\Application
     */
    function redirect($abstract = null, array $parameters = [])
    {
        
        $response = response();
        $response->setStatusCode(301);
        $response->headers['Location'] =  $abstract;
         
    }
}

if (! function_exists('get_var')) {

    function get_var(object|array $array, string $key = null)
    {
        if(is_object($array)) {
            if(!property_exists($array, $key)) return;
            return $array->{$key};
        }

        if(is_array($array)) {
            if(!array_key_exists($key, $array) && !isset($array[$key])) return;
            return $array[$key];
        }
    }   
}
