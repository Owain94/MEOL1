<?php

require_once('../../Slim/Slim.php');
require_once('../../Keys.php');
require_once('../../Database.php');

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();
$database = new Database();

$app->get(
    '/dieren',
    function ()
    use ($database) {
        $database->query('SELECT `meol1_dieren`.`id`,
                                 `meol1_dieren`.`naam`
                          FROM    meol1_dieren');

        $result = $database->resultset();

        print_r(json_encode($result));
    }
);

$app->get(
    '/dieren/:x',
    function ($x)
    use ($database) {
        if (empty($x)) return;

        $database->query('SELECT  *
                          FROM    meol1_dieren
                          WHERE  `meol1_dieren`.`id` = ?');

        $database->bind(1, $x);
        $result = $database->single();

        print_r(json_encode($result));
    }
);

$app->get(
    '/dieren/:x/eigenaar',
    function ($x)
    use ($database) {
        if (empty($x)) return;

        $database->query('SELECT `meol1_dieren`.`eigenaar_id`
                          FROM    meol1_dieren
                          WHERE  `meol1_dieren`.`id` = ?');

        $database->bind(1, $x);
        $result = $database->single();

        print_r(json_encode($result));
    }
);

$app->get(
    '/eigenaars',
    function ()
    use ($database) {
        $database->query('SELECT `meol1_eigenaars`.`id`,
                                 `meol1_eigenaars`.`tussenvoegsel`,
                                 `meol1_eigenaars`.`voornaam`,
                                 `meol1_eigenaars`.`achternaam`
                          FROM   `meol1_eigenaars`');

        $result = $database->resultset();

        print_r(json_encode($result));
    }
);

$app->get(
    '/eigenaars/:x',
    function ($x)
    use ($database) {
        if (empty($x)) return;

        $database->query('SELECT  *
                          FROM    meol1_eigenaars
                          WHERE  `meol1_eigenaars`.`id` = ?');

        $database->bind(1, $x);
        $result = $database->single();

        print_r(json_encode($result));
    }
);

$app->get(
    '/eigenaars/:x/dieren',
    function ($x)
    use ($database) {
        if (empty($x)) return;

        $database->query('SELECT `meol1_dieren`.`id`,
                                 `meol1_dieren`.`naam`
                          FROM    meol1_dieren
                          WHERE  `meol1_dieren`.`eigenaar_id` = ?');

        $database->bind(1, $x);
        $result = $database->resultset();

        print_r(json_encode($result));
    }
);

$app->post(
    '/dieren',
    function ()
    use ($app, $database) {
        $database->query('INSERT INTO meol1_dieren
                                      (naam, soort, geboortejaar, eigenaar_id)
                          VALUES      (?, ?, ?, ?)');
        $database->bind(1, $app->request()->post('naam'));
        $database->bind(2, $app->request()->post('soort'));
        $database->bind(3, $app->request()->post('geboortejaar'));
        $database->bind(4, $app->request()->post('eigenaar_id'));
        $database->execute();
        echo $database->lastInsertId();
    }
);

$app->post(
    '/eigenaars',
    function ()
    use ($app, $database) {
        $database->query('INSERT INTO meol1_dieren
                                      (voornaam, tussenvoegsel, achternaam, plaats)
                          VALUES      (?, ?, ?, ?)');
        $database->bind(1, $app->request()->post('voornaam'));
        $database->bind(2, $app->request()->post('tussenvoegsel'));
        $database->bind(3, $app->request()->post('achternaam'));
        $database->bind(4, $app->request()->post('plaats'));
        $database->execute();
        echo $database->lastInsertId();
    }
);

$app->run();
