<?
/**
 * Created by PhpStorm.
 * User: Owain
 * Date: 09/11/14
 * Time: 20:18
 */

require_once('REST.php');
if (!empty($_GET['command']) && !empty($_GET['id'])) {
    $rest = new REST($_GET['command'], $_GET['id']);

    echo "De methode is: " . $rest->method . "<br />";
    echo "Het commando is: " . $rest->command . "<br />";
    echo "De id is: " . $rest->id . "<br />";
} else {
    echo "Oeps er is iets mis gegaan";
}
