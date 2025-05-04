<?php

namespace app;

require_once __DIR__ . '/Checker.php';

class Cache
{
    public static function create($name, $value = '', $expires = 60)
    {
        $path = Path::temp('/cache');
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
        $file = $path . '/cach_' . Security::encrypt($name);
        $value = Security::encode($value);
        $value = serialize(['expires' => $expires + time(), 'value' => $value]);
        file_put_contents($file, $value);
    }

    public static function read($name)
    {
        $file = Path::temp('/cache/cach_' . Security::encrypt($name));
        if (file_exists($file)) {
            $value = unserialize(file_get_contents($file));
            if ($value['expires'] > time()) {
                return Security::decode($value['value']);
            } else {
                unlink($file);
                return false;
            }
        }
        return false;
    }
}
