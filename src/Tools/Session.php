<?php

namespace Core\Tools;


class Session
{

    public function __construct()
    {

    }
    
    public static function init()
    {
        if(!headers_sent()) {
            session_start();
        }
    }

    public static function set($name, $value)
    {
        static::init();
        $_SESSION[$name] = $value;
    }
    
    public static function get($name)
    {
        static::init();
        if(isset($_SESSION[$name])) {
            return $_SESSION[$name];
        }
    }

    public static function __callStatic($name, $arguments)
    {
        return static::get($name);
    }
}
