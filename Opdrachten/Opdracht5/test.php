<?
/**
 * Created by PhpStorm.
 * User: Owain
 * Date: 10/11/14
 * Time: 03:50
 */

require_once("../../Keys.php");

$key = CONSUMER_KEY;
$secret = PRIVATE_KEY;

$timestamp = time();
$signature = hash_hmac('sha1', "timestamp=" . $timestamp, $secret);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://66164.ict-lab.nl/MEOL1/Opdrachten/Opdracht5/api/dieren");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/x-www-form-urlencoded","key: " . $key,"sig: " . $signature,"timestamp: " . time()));
$response = curl_exec($ch);
curl_close($ch);

echo $response;