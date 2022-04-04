<?php

namespace app\controllers;

defined('APP_PATH') or exit(header('Location: /', true, 301));

class NotFound {
    private $params;

    function __construct($params) {
        $this->params = $params;
        $this->params['title'] = '404 Not Found';
        $this->params['description'] = 'The page you requested does not exist or has been moved';
        $this->params['robots'] = 'noindex, nofollow';
        echo response('/Default', 404, $this->params);
    }
}
