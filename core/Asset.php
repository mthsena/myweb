<?php

namespace app;

require_once __DIR__ . '/Checker.php';

class Asset
{
    public static function css($path)
    {
        $minifier = new \MatthiasMullie\Minify\CSS(Path::dir('/app/asset/css' . $path));
        return $minifier->minify();
    }

    public static function js($path)
    {
        $minifier = new \MatthiasMullie\Minify\JS(Path::dir('/app/asset/js' . $path));
        return $minifier->minify();
    }

    public static function image($path)
    {
        return Path::host('/app/asset/image' . $path);
    }
}
