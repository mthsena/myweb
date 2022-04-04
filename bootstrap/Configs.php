<?php

define('APP_START_TIME',      microtime(true));
define('APP_PHP_EXT',         '.php');
define('APP_PATH',            str_replace('\\', '/', dirname(__DIR__)));
define('APP_URI',             urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)));
define('APP_SCHEME',          isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http');
define('APP_HOST',            APP_SCHEME . '://' . $_SERVER['HTTP_HOST']);
define('APP_OFFLINE',         false);
define('APP_DEBUG',           true);
define('APP_DIR',             '');
define('APP_SECRET',          '5HK3AYPwP5cXKz7rKFmfVNK9y22g4AGK');
define('APP_TITLE',           'My Web');
define('APP_DESCRIPTION',     'My Web');
define('APP_KEYWORDS',        'My Web');

define('DB_DRIVER',   'mysql');
define('DB_HOST',     '127.0.0.1');
define('DB_PORT',     '3306');
define('DB_CHARSET',  'utf8');
define('DB_NAME',     'database');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');

define('SMTP_HOST',     'mail.domain.com');
define('SMTP_USERNAME', 'mail_user@domain.com');
define('SMTP_PASSWORD', 'mail_pass');

ini_set('max_execution_time',     10);
ini_set('date.timezone',          'America/Sao_Paulo');
ini_set('default_charset',        'UTF-8');
ini_set('display_errors',         APP_DEBUG ? 1 : 0);
ini_set('display_startup_errors', APP_DEBUG ? 1 : 0);
ini_set('error_reporting',        APP_DEBUG ? E_ALL : 0);
ini_set('session.save_path',      path('/storage/sessions'));
ini_set('session.name',           encrypt(APP_SECRET));
