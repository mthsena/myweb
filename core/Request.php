<?php

namespace app;

require_once __DIR__ . '/Checker.php';

class Request
{
    public static function upload($files, $allowedExtensions)
    {
        $uploads = [];
        if (!empty($files)) {
            $result = [$files];
            if (is_array($files['name'])) {
                $result = [];
                $count = count($files['name']);
                $keys = array_keys($files);
                for ($i = 0; $i < $count; $i++) {
                    foreach ($keys as $key) {
                        $result[$i][$key] = $files[$key][$i];
                    }
                }
            }
            if (!empty($result)) {
                foreach ($result as $r) {
                    $ext = pathinfo($r['name'], PATHINFO_EXTENSION);
                    if (in_array($ext, $allowedExtensions)) {
                        $path = Path::temp('/upload');
                        if (!is_dir($path)) {
                            mkdir($path, 0777, true);
                        }
                        $upload = $path . '/uplo_' . Security::uuid() . '.' . $ext;
                        if (!move_uploaded_file($r['tmp_name'], $upload)) {
                            return false;
                        }
                        array_push($uploads, $upload);
                    }
                }
            }
        }
        return $uploads;
    }

    public static function curl($options)
    {
        $curl = curl_init();
        curl_setopt_array($curl, $options);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    public static function redirect($url)
    {
        exit(header('Location: ' . $url, true, 301));
    }

    public static function controller($controller, $params)
    {
        $request['request'] = [
            'header' => getallheaders(),
            'method' => $_SERVER['REQUEST_METHOD'],
            'client' => $_SERVER['REMOTE_ADDR'],
            'params' => array_merge($_GET, $_POST, $_FILES, $params),
        ];
        $controller = 'app' . str_replace('/', '\\', $controller);
        return new $controller($request);
    }
}
