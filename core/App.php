<?php

namespace app;

require_once __DIR__ . '/Checker.php';

class App
{
    public static function initialize()
    {
        ini_set('max_execution_time',     Config::$maxExecutionTime);
        ini_set('date.timezone',          Config::$timeZone);
        ini_set('default_charset',        Config::$charset);
        ini_set('display_errors',         Config::$isDebug ? 1 : 0);
        ini_set('display_startup_errors', Config::$isDebug ? 1 : 0);
        ini_set('error_reporting',        Config::$isDebug ? E_ALL : 0);
        ini_set('session.save_path',      Path::temp('/session'));
        ini_set('session.name',           Security::encrypt(Config::$secretKey));
        Router::initialize();
    }
}
