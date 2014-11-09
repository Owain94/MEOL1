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
        $template = <<<EOT
<!DOCTYPE html>
    <html>
        <head>
        </head>
        <body>
            <form method="POST" action="">
                <table border="0">
                    <tr>
                        <td>
                            Voornaam:
                        </td>
                        <td>
                            <input type="text" name="voornaam">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Achternaam:
                        </td>
                        <td>
                            <input type="text" name="achternaam">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            lievelings getal:
                        </td>
                        <td>
                            <input type="text" name="getal">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Leuke kleur:
                        </td>
                        <td>
                            <input type="text" name="kleur">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Doe iets leuks joh:
                        </td>
                        <td>
                            <input type="text" name="leuk">
                        </td>
                    </tr>
                        <td>
                            &nbsp;
                        </td>
                        <td>
                            <input type="submit" value="Verstuur">
                        </td>
                    </tr>
                </table>
            </form>
        </body>
    </html>
EOT;
        echo $template;
    }
);

$app->post(
    '/test',
    function ()
    use ($app) {
        echo "Voornaam: " . $app->request()->post('voornaam') . "<br />";
        echo "Achternaam: " . $app->request()->post('achternaam') . "<br />";
        echo "Lievelings getal: " . $app->request()->post('getal') . "<br />";
        echo "Leuke kleur: " . $app->request()->post('kleur') . "<br />";
        echo "Iets leuks: " . $app->request()->post('leuk');
    }
);

$app->run();
