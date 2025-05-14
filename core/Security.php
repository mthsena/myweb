<?php

namespace app;

require_once __DIR__ . '/Checker.php';

class Security
{
    public static function encode($data)
    {
        $data = base64_encode($data);
        $data = str_replace(['+', '/', '='], ['-', '_', ''], $data);
        $data = strrev($data);
        return $data;
    }

    public static function decode($data)
    {
        $data = strrev($data);
        $data = str_replace(['-', '_'], ['+', '/'], $data);
        $data = base64_decode($data);
        return $data;
    }

    public static function encrypt($data)
    {
        $hash = hash_hmac('sha256', $data, Config::$secretKey, true);
        $hash = strrev($hash);
        $hash = bin2hex($hash);
        return hash_hmac('sha256', $data, $hash);
    }

    public static function token($length = 6)
    {
        $bytes = random_bytes($length);
        $bytes = strrev($bytes);
        return bin2hex($bytes);
    }

    public static function uuid()
    {
        return self::encrypt(\Ramsey\Uuid\Uuid::uuid4());
    }
}
