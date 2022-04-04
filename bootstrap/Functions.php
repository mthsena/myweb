<?php

function redirect($url) {
    exit(header('Location: ' . $url, true, 301));
}

function path($path) {
    return APP_PATH . $path;
}

function host($host) {
    return APP_HOST . $host;
}

function encode($data) {
    $data = base64_encode($data);
    $data = str_replace(['+', '/', '='], ['-', '_', ''], $data);
    $data = strrev($data);
    return $data;
}

function decode($data) {
    $data = strrev($data);
    $data = str_replace(['-', '_'], ['+', '/'], $data);
    $data = base64_decode($data);
    return $data;
}

function encrypt($data) {
    $hash = hash_hmac('sha256', $data, APP_SECRET, true);
    $hash = strrev($hash);
    $hash = bin2hex($hash);
    return hash_hmac('sha256', $data, $hash);
}

function token($length = 64) {
    $length = $length / 2;
    $bytes = random_bytes($length);
    return bin2hex($bytes);
}

function createCookie($name, $value = '', $expires = 1, $path = '/', $domain = '', $secure = false, $httpOnly = false) {
    $name = encrypt($name);
    $value = encode($value);
    setcookie($name, $value, $expires, $path, $domain, $secure, $httpOnly);
}

function readCookie($name) {
    $name = encrypt($name);
    return empty($_COOKIE[$name]) ? false : decode($_COOKIE[$name]);
}

function deleteCookie($name) {
    createCookie($name);
}

function startSession() {
    if (session_status() == PHP_SESSION_NONE) {
        if (!is_dir(ini_get('session.save_path'))) {
            mkdir(ini_get('session.save_path'));
        }
        session_start();
    }
}

function createSession($name, $value = '') {
    startSession();
    $name = encrypt($name);
    $value = encode($value);
    $_SESSION[$name] = $value;
}

function readSession($name) {
    startSession();
    $name = encrypt($name);
    return empty($_SESSION[$name]) ? false : decode($_SESSION[$name]);
}

function deleteSession() {
    startSession();
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', 1, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }
    session_destroy();
}

function createCache($name, $value = '', $expires = 60) {
    $path = path('/storage/caches');
    if (!is_dir($path)) {
        mkdir($path);
    }
    $file = $path . '/cach_' . encrypt($name);
    $value = encode($value);
    $value = serialize(['expires' => $expires + time(), 'value' => $value]);
    file_put_contents($file, $value);
}

function readCache($name) {
    $file = path('/storage/caches/cach_' . encrypt($name));
    if (file_exists($file)) {
        $value = unserialize(file_get_contents($file));
        if ($value['expires'] > time()) {
            return decode($value['value']);
        } else {
            unlink($file);
        }
    }
    return false;
}

function upload($files, $filter) {
    if (!empty($files)) {
        foreach ($files as $file) {
            $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
            if (in_array($extension, $filter)) {
                $path = path('/storage/uploads');
                if (!is_dir($path)) {
                    mkdir($path);
                }
                $upload = $path . '/uplo_' . token() . '.' . $extension;
                if (!move_uploaded_file($file['tmp_name'], $upload)) {
                    return false;
                } else {
                    return $upload;
                }
            }
        }
    }
    return false;
}

function curl($options) {
    $curl = curl_init();
    curl_setopt_array($curl, $options);
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}

function mailer($to, $subject, $body) {
    $mailer = new \PHPMailer\PHPMailer\PHPMailer(false);
    $mailer->isSMTP();
    $mailer->SMTPAuth = true;
    $mailer->CharSet = 'UTF-8';
    $mailer->Host = SMTP_HOST;
    $mailer->Username = SMTP_USERNAME;
    $mailer->Password = SMTP_PASSWORD;
    $mailer->SMTPSecure = 'ssl';
    $mailer->Port = 465;
    $mailer->addCustomHeader('X-Priority: 1');
    $mailer->addCustomHeader('X-MSMail-Priority: High');
    $mailer->setFrom(SMTP_USERNAME, APP_TITLE);
    $mailer->addAddress($to);
    $mailer->isHTML(true);
    $mailer->Subject = $subject;
    $mailer->Body = $body;
    return $mailer->send();
}

function database($query, $table, $params) {
    $connection = new \PDO(sprintf('%s:host=%s;dbname=%s;port=%s;charset=%s;', DB_DRIVER, DB_HOST, DB_NAME, DB_PORT, DB_CHARSET), DB_USERNAME, DB_PASSWORD);
    $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    $stmt = $connection->prepare(sprintf($query, $table));
    $stmt->execute($params);
    return $stmt;
}

function minify($file) {
    $minifier = strpos($file, '.css') ? new \MatthiasMullie\Minify\CSS($file) : new \MatthiasMullie\Minify\JS($file);
    return $minifier->minify();
}

function route($method, $uri, $controller, $router) {
    $router->map($method, $uri, function ($params) use ($controller) {
        request($controller, $params);
    });
    return $router;
}

function request($controller, $params) {
    $request['controller'] = $controller;
    $request['method'] = $_SERVER['REQUEST_METHOD'];
    $request['ip'] = $_SERVER['REMOTE_ADDR'];
    $request['get'] = array_merge($_GET, isset($params) ? $params : []);
    $request['post'] = $_POST;
    $request['file'] = $_FILES;
    $controller = str_replace('/', '\\', 'app\\controllers' . $controller);
    return new $controller($request);
}

function asset($file) {
    return path('/storage/assets') . $file . APP_PHP_EXT;
}

function view($file) {
    return path('/app/views') . $file . APP_PHP_EXT;
}

function component($file) {
    return path('/app/components') . $file . APP_PHP_EXT;
}

function response($view, $code, $params) {
    http_response_code($code);
    ob_start();
    extract(['params' => $params], EXTR_OVERWRITE);
    include component('/Top');
    include view($view);
    include component('/Bottom');
    $output = ob_get_clean();
    $htmlMin = new \voku\helper\HtmlMin();
    $htmlMin->doOptimizeViaHtmlDomParser();
    $htmlMin->doRemoveComments();
    $htmlMin->doSumUpWhitespace();
    $htmlMin->doRemoveWhitespaceAroundTags();
    $htmlMin->doOptimizeAttributes();
    $htmlMin->doRemoveHttpPrefixFromAttributes();
    $htmlMin->doRemoveDefaultAttributes();
    $htmlMin->doRemoveDeprecatedAnchorName();
    $htmlMin->doRemoveDeprecatedScriptCharsetAttribute();
    $htmlMin->doRemoveDeprecatedTypeFromScriptTag();
    $htmlMin->doRemoveDeprecatedTypeFromStylesheetLink();
    $htmlMin->doRemoveEmptyAttributes();
    $htmlMin->doRemoveValueFromEmptyInput();
    $htmlMin->doSortCssClassNames();
    $htmlMin->doSortHtmlAttributes();
    $htmlMin->doRemoveSpacesBetweenTags();
    $htmlMin->doRemoveOmittedQuotes();
    $htmlMin->doRemoveOmittedHtmlTags();
    return APP_DEBUG ? $output : $htmlMin->minify($output);
}

function initialize() {
    if (!APP_OFFLINE) {
        $router = new \AltoRouter([], APP_DIR, []);
        include path('/bootstrap/Routes') . APP_PHP_EXT;
        $match = $router->match();
        if (is_array($match) && is_callable($match['target'])) {
            call_user_func_array($match['target'], [$match['params']]);
        } else {
            request('/NotFound', []);
        }
    } else {
        request('/Unavailable', []);
    }
    if (APP_DEBUG) {
        $appEndTime = microtime(true);
        printf("<center>Page loaded in %f seconds</center>", $appEndTime - APP_START_TIME);
    }
}
