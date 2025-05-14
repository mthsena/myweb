<?php

namespace app;

require_once __DIR__ . '/Checker.php';

class Database
{
    public static function query($query, $params)
    {
        $dsn = '%s:host=%s;dbname=%s;port=%s;charset=%s;';
        $dsn = sprintf($dsn, Config::$dbDriver, Config::$dbHost, Config::$dbName, Config::$dbPort, Config::$dbCharset);
        $connection = new \PDO($dsn, Config::$dbUser, Config::$dbPass);
        $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $stmt = $connection->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
