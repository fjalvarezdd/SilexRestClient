<?php

use SilexRestClient\src\Rest;

require_once __DIR__.'/../vendor/autoload.php';
require_once (BASE_DIR . '/src/Rest.php');

$app = new Silex\Application();

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => BASE_DIR.'/views',
));

$app['rest'] = $app->share(function() use($app){
    return new Rest($app['auth.string']);
});