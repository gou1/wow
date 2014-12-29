<?php

use Symfony\Component\HttpFoundation\Request;

if (isset($_SERVER['HTTP_CLIENT_IP'])
    || isset($_SERVER['HTTP_X_FORWARDED_FOR'])
    || !(in_array(@$_SERVER['REMOTE_ADDR'], array('127.0.0.1', 'fe80::1', '::1')) || substr($_SERVER['REMOTE_ADDR'], 0, 8)=='192.168.' || php_sapi_name() === 'cli-server')
) {
    header('HTTP/1.0 403 Forbidden');
    exit('You are not allowed to access this file. Check '.basename(__FILE__).' for more information.');
}

require_once __DIR__.'/vendor/autoload.php';

$request = Request::createFromGlobals();

echo new App($request->getUriForPath('/../../api/app_dev.php').'');