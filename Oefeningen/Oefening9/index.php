<?php

require '../../Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$app->get(
    '/test3/:one/:two',
    function($one, $two) {
        echo "De eerste parameter is: " . $one . "<br />";
        echo "De tweede parameter is: " . $two;
    }
);

$app->run();
