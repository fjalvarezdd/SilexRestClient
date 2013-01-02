<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Silex\Application;

$app->get('/view-comments.html', function() use($app){
    
    $url = $app['rest.host'] . 'view-comments.json';
    $comments = json_decode($app['rest']->url($url)->get());
    
    return $app['twig']->render('comments.html.twig', array(
        'comments' => $comments
    ));
    
});

return $app;