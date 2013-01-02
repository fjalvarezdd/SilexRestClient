<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

require_once (BASE_DIR . '/src/config.php');
require_once (BASE_DIR . '/src/bootstrap.php');
$app = require(BASE_DIR . '/src/controllers.php');

/**
  * This method runs before any action defined in the
  * src/controllers.php
  *
  * In this case handles authentication using "HTTP Basic Authentication"
  * If you have not received your username and password correctly
  * Returns the error code 403 - Unauthorized. In case of not wanting to control
  * Service using a username and password could comment on the content
  */
$app->before(function (Request $request) use ($app){
    
    $user = $request->server->get('PHP_AUTH_USER');
    $pass = $request->server->get('PHP_AUTH_PW');
    
    if($app['auth.user'] != $user || $app['auth.pass'] != $pass)
    {
        return new Response('Unauthorized', 403, array('WWW-Authenticate' => 'Basic realm="Authentication required"'));
    }
    
});

/**
  * This method manages the place errors will not
  * Managed and controlled by us as a general catch.
  */
$app->error(function(\Exception $e, $code) use($app){
    
    if ($app['debug'])
        return ;
    switch($code)
    {
        case 404:
            $message = 'The page you are looking for does not exist.';
            break;
        default:
            $message = 'An error has occurred while processing your request.';
            break;
    }

    return new Response($message, $code);
    
});

return $app;