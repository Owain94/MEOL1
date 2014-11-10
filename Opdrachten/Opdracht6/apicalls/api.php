<?
/**
 * Created by PhpStorm.
 * User: Owain
 * Date: 10/11/14
 * Time: 14:52
 */

function api($function, $post = false, $fields = null) {
    $fields_string = null;

    if ($post) {
        foreach($fields as $key=>$value) {
            $fields_string .= $key.'='.$value.'&';
        }
        rtrim($fields_string, '&');
    }

    $key = CONSUMER_KEY;
    $secret = PRIVATE_KEY;

    $timestamp = time();
    $signature = hash_hmac('sha1', 'timestamp=' . $timestamp, $secret);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://66164.ict-lab.nl/MEOL1/Opdrachten/Opdracht5/api/' . $function);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded','key: ' . $key,'sig: ' . $signature,'timestamp: ' . time()));
    if ($post) {
        curl_setopt($ch,CURLOPT_POST, count($fields));
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
        $response = curl_exec($ch);
    } else {
        $response = json_decode(curl_exec($ch));
    }
    curl_close($ch);

    return $response;
}