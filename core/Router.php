<?php

namespace app;

require_once __DIR__ . '/Checker.php';

class Router
{
    private static $router;

    public static function map($method, $uri, $controller)
    {
        self::$router->map($method, $uri, function ($params) use ($controller) {
            Request::controller($controller, $params);
        });
    }

    public static function initialize()
    {
        if (Config::$isOffline) {
            Request::controller(Config::$controllerUnavailable, []);
            return;
        }
        self::$router = new \AltoRouter([], Config::$baseDir, []);
        require_once Path::dir(Config::$routeFile);
        $match = self::$router->match();
        $isMatch = is_array($match) && is_callable($match['target']);
        if (!$isMatch) {
            Request::controller(Config::$controllerNotFound, []);
            return;
        }
        call_user_func_array($match['target'], [$match['params']]);
        if (Config::$showLoadTime) {
            printf("<center>Page loaded in %f seconds</center>", (microtime(true) - APP_START));
        }
    }
}
