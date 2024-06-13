<?php

namespace Core\Tools;


class Cookie
{

    public function __construct()
    {
    }

    public static function init()
    {
        if (!headers_sent()) {
            session_start();
        }
    }

    public static function set($name, $value, $expires, $path = '', $domain = '', $secure = '', $http = '')
    {
        setcookie(...[$name, $value, $expires,$path, $domain, $secure, $http]);

    }

    public static function get($name)
    {
        static::init();
        if (isset($_COOKIE[$name])) {
            return $_COOKIE[$name];
        }
    }

    public static function __callStatic($name, $arguments)
    {
        return static::get($name);
    }
}
