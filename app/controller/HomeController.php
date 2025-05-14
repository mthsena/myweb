<?php

namespace app;

require_once dirname(__DIR__, 2) . '/core/Checker.php';

class HomeController
{
    function __construct($request)
    {
        $params['title'] = 'Home';
        $params['description'] = 'Home';
        $params['keywords'] = 'home';
        $params['robots'] = 'noindex, nofollow';
        Response::view([], 200, '/HomeView', $params);
    }
}
