<?php

namespace app;

require_once __DIR__ . '/Checker.php';

class Session
{
    public static function start()
    {
        if (session_status() == PHP_SESSION_NONE) {
            $path = Path::temp('/session');
            if (!is_dir($path)) {
                mkdir($path, 0777, true);
            }
            session_start();
        }
    }

    public static function create($name, $value = '')
    {
        self::start();
        $name = Security::encrypt($name);
        $value = Security::encode($value);
        $_SESSION[$name] = $value;
    }

    public static function read($name)
    {
        self::start();
        $name = Security::encrypt($name);
        return empty($_SESSION[$name]) ? false : Security::decode($_SESSION[$name]);
    }

    public static function clean()
    {
        self::start();
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', 1, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
        }
        session_destroy();
    }
}
