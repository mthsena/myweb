<?php

namespace app;

require_once dirname(__DIR__, 2) . '/core/Checker.php';

class NotFoundController
{
    function __construct($request)
    {
        $params['title'] = '404 Not Found';
        $params['description'] = 'The page you requested does not exist or has been moved';
        $params['keywords'] = '404 not found';
        $params['robots'] = 'noindex, nofollow';
        Response::view([], 404, '/NotFoundView', $params);
    }
}
