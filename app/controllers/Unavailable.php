<?php

namespace app\controllers;

defined('APP_PATH') or exit(header('Location: /', true, 301));

class Unavailable {
    private $params;

    function __construct($params) {
        $this->params = $params;
        $this->params['title'] = '503 Service Unavailable';
        $this->params['description'] = 'We are under maintenance but dont worry, well be back soon';
        $this->params['robots'] = 'noindex, nofollow';
        echo response('/Default', 503, $this->params);
    }
}
