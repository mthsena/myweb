<?php

namespace app\controllers;

defined('APP_PATH') or exit(header('Location: /', true, 301));

class Home {
    private $params;

    function __construct($params) {
        $this->params = $params;
        $this->params['title'] = 'Home';
        $this->params['description'] = 'Home.';
        $this->params['robots'] = 'noindex, nofollow';
        echo response('/Default', 200, $this->params);
    }
}
