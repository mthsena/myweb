<?php

namespace app;

require_once dirname(__DIR__, 2) . '/core/Checker.php';

class UnavailableController
{
    function __construct($request)
    {
        $params['title'] = '503 Service Unavailable';
        $params['description'] = 'We are under maintenance but dont worry, well be back soon';
        $params['keywords'] = '503 service unavailable';
        $params['robots'] = 'noindex, nofollow';
        Response::view([], 503, '/UnavailableView', $params);
    }
}
