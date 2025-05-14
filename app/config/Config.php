<?php

namespace app;

require_once dirname(__DIR__, 2) . '/core/Checker.php';

class Config
{
    public static $isOffline = false;
    public static $isDebug = true;
    public static $showLoadTime = true;
    public static $maxExecutionTime = 10;
    public static $timeZone = 'America/Sao_Paulo';

    public static $baseDir = '';

    public static $routeFile = '/app/route/Route.php';

    public static $secretKey = '5HK3AYPwP5cXKz7rKFmfVNK9y22g4AGK';

    public static $lang = 'pt-BR';
    public static $charset = 'UTF-8';

    public static $title = 'My Web';
    public static $description = 'My Web';
    public static $keyword = 'My Web';

    public static $controllerNotFound = '/NotFoundController';
    public static $controllerUnavailable = '/UnavailableController';

    public static $dbDriver = 'mysql';
    public static $dbHost = '127.0.0.1';
    public static $dbPort = '3306';
    public static $dbCharset = 'utf8';
    public static $dbName = 'database';
    public static $dbUser = 'root';
    public static $dbPass = '';

    public static $smtpHost = 'mail.domain.com';
    public static $smtpCharset = 'UTF-8';
    public static $smtpUser = 'mail_user@domain.com';
    public static $smtpPass = 'mail_pass';
}
