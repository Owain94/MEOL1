<?
/**
 * Created by PhpStorm.
 * User: Owain
 * Date: 09/11/14
 * Time: 19:56
 */

$method = strtoupper($_GET['method']);

$url = 'http://66164.ict-lab.nl/MEOL1/Opdrachten/Opdracht2/api/Owie/Woehoe';

$fields = 'command=Owie&id=Woehoe';

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

switch ($method) {
    case 'GET':
        break;
    case 'POST':
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        break;
    case 'PUT':
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        break;
    case 'DELETE':
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        break;
}

$data = curl_exec($ch);

curl_close($ch);

echo $data;