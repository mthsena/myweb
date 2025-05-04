<?php

namespace app;

require_once __DIR__ . '/Checker.php';

class Asset
{
    public static function css($path)
    {
        $minifier = new \MatthiasMullie\Minify\CSS(Path::dir('/asset/css' . $path));
        return $minifier->minify();
    }

    public static function js($path)
    {
        $minifier = new \MatthiasMullie\Minify\JS(Path::dir('/asset/js' . $path));
        return $minifier->minify();
    }

    public static function image($path)
    {
        return Path::dir('/asset/image' . $path);
    }
}
