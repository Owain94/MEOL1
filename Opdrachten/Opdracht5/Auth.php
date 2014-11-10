<?
/**
 * Created by PhpStorm.
 * User: Owain
 * Date: 10/11/14
 * Time: 03:53
 */

function Authenticate($key, $timestamp, $sendsignature) {
    $database = new Database();

    $database->query('SELECT `meol1_consumers`.`private`
                      FROM    meol1_consumers
                      WHERE  `meol1_consumers`.`consumer` = ?');

    $database->bind(1, $key);
    $result = $database->single();

    $signature = hash_hmac('sha1', "timestamp=" . $timestamp, $result['private']);

    $time = (time() - $timestamp) / 60;
    if (($signature == $sendsignature) && ($time < 5)) {
        return true;
    } else {
        return false;
    }
}