<?php

require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$app->get(
    '/test',
    function() {
        $template = <<<EOT
<!DOCTYPE html>
    <html>
        <head>
        </head>
        <body>
            <form method="POST" action="test2">
                <input type="submit" value="Verstuur">
            </form>
        </body>
    </html>
EOT;
        echo $template;
    }
);

$app->map(
    '/test2',
    function()
    use ($app) {
        if ($app->request()->isPost()) {
            echo "Dit is een POST <br />";
        } else if ($app->request()->isGet()) {
            echo "Dit is een GET <br />";
        }
        echo "Klaar!";
    }
)->via("GET", "POST");

$app->run();
