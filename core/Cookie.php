<?php

namespace app;

require_once __DIR__ . '/Checker.php';

class Cookie
{
    public static function create($name, $value = '', $expires = 1, $path = '/', $domain = '', $secure = false, $httpOnly = false)
    {
        $name = Security::encrypt($name);
        $value = Security::encode($value);
        setcookie($name, $value, $expires, $path, $domain, $secure, $httpOnly);
    }

    public static function read($name)
    {
        $name = Security::encrypt($name);
        return empty($_COOKIE[$name]) ? false : Security::decode($_COOKIE[$name]);
    }

    public static function delete($name)
    {
        self::create($name);
    }
}
