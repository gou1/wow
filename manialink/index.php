<?php

use Symfony\Component\HttpFoundation\Request;

require_once __DIR__.'/vendor/autoload.php';

$request = Request::createFromGlobals();

echo new App($request->getUriForPath('/../api/web').'');