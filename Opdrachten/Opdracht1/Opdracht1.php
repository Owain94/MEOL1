<?
/**
 * Created by PhpStorm.
 * User: Owain
 * Date: 08/11/14
 * Time: 22:07
 */
error_reporting(E_ALL);

require_once('../../Keys.php');
require_once('Weather.php');

$weather = new Weather($_GET['lat'], $_GET['long'], APIKEY);

$location = $weather->location;
$temperature = $weather->temperature;
$wind = $weather->wind;
$satellite = $weather->satellite;

$values = [
    0 => 'Land:|' . $weather->country,
    1 => 'Stad:|' . $weather->city,
    2 => 'Latitude (wunderground):|' . $location[0],
    3 => 'Longitude (wunderground):|' . $location[1],
    4 => 'Latitude (javascript):|' . $_GET['lat'],
    5 => 'Longitude (javascript):|' . $_GET['long'],
    6 => 'Temperatuur:|' . $temperature[0] . '°C (' . $temperature[1] . '°F)',
    7 => 'Gevoels temperatuur:|' . $temperature[2] . '°C (' . $temperature[3] . '°F)',
    8 => 'Windsnelheid:|' . $wind[0] . 'km/h (' . $wind[1] . 'mph)',
    9 => 'Windrichting:|' . $wind[2] . ' (' . $wind[3] . '°)',
    10 => 'Weer icoon:|' . '<img src="' . $weather->weathericon . '" />',
    11 => 'Satellietfoto:|' . '<img src="data:' . $satellite[0] . ';base64,' . $satellite[1] . '" />'
];

?>

<h2>Lokale weer gegevens</h2>

<table border='0'>
    <? foreach ($values as $value):
        $value = explode('|', $value); ?>
        <tr>
            <td>
                <? echo $value[0]; ?>
            </td>
            <td>
                <? echo $value[1]; ?>
            </td>
        </tr>
    <? endforeach; ?>
</table>

<h2>Weerstations</h2>

<table border='1'>
    <thead>
    <tr>
        <th>
            ID
        </th>
        <th>
            Land
        </th>
        <th>
            Stad
        </th>
        <th>
            Latitude
        </th>
        <th>
            Longitude
        </th>
        <th>
            Afstand
        </th>
    </tr>
    </thead>
    <tbody>
    <?
    $i = 0;
    foreach ($weather->weatherstations as $station):
        ?>
        <tr>
            <td>
                <? echo $station->{'id'}; ?>
            </td>
            <td>
                <? echo $station->{'country'}; ?>
            </td>
            <td>
                <? echo $station->{'city'}; ?>
            </td>
            <td>
                <? echo $station->{'lat'}; ?>
            </td>
            <td>
                <? echo $station->{'lon'}; ?>
            </td>
            <td>
                <? echo $station->{'distance_km'}; ?>km (<? echo $station->{'distance_mi'}; ?> mijl)
            </td>
        </tr>
        <?
        if (10 == ++$i) break;
    endforeach;
    ?>
    </tbody>
</table>