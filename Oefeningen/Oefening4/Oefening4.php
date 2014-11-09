<?

$url = "http://api.wunderground.com/api/aaa88a19e94c37f5/geolookup/q/France/Paris.json";

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$data = curl_exec($ch);

curl_close($ch);

$parsed_json = json_decode($data);

$location = $parsed_json->{'location'}->{'city'};

echo $location;