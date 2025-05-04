<?php

namespace app;

require_once __DIR__ . '/Checker.php';

class Path
{
    public static function scheme()
    {
        return isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http';
    }

    public static function uri()
    {
        return urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    }

    public static function host($uri)
    {
        return self::scheme() . '://' . $_SERVER['HTTP_HOST'] . $uri;
    }

    public static function dir($path)
    {
        return str_replace('\\', '/', dirname(__DIR__)) . '/app' . $path;
    }

    public static function temp($path)
    {
        return str_replace('\\', '/', sys_get_temp_dir()) . '/' . Security::encrypt(Config::$secretKey) . $path;
    }
}
