<?php

define('BASE_DIR', realpath(__DIR__ . '/..'));

$app = require_once (BASE_DIR . '/src/app.php');

$app['debug'] = true;

$app['auth.user'] = AUTH_USER;
$app['auth.pass'] = AUTH_PASS;
$app['auth.string'] = $app['auth.user'] . ':' . $app['auth.pass'];
$app['rest.host'] = 'http://local.SilexRestServer/';

$app->run();