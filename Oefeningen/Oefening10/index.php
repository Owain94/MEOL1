<?php

require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$app->get(
    '/hallo/:name+',
    function($name) {
        print_r($name);
    }
);

$app->run();
