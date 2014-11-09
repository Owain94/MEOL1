<?php

require '../../Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$app->get(
    '/',
    function () {
        echo "Ja, hij doet het!";
    }
);

$app->get(
    '/test',
    function () {
        echo "Testing, 1, 2, 3!";
    }
);

$app->run();
