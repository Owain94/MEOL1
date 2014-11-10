<?
/**
 * Created by PhpStorm.
 * User: Owain
 * Date: 10/11/14
 * Time: 19:11
 */

require_once('../../../Keys.php');
require_once('api.php');

$name = $_POST['name'];
$kind = $_POST['kind'];
$dob = $_POST['dob'];
$owner = $_POST['owner'];

if(empty($name) ||
   empty($kind) ||
   empty($dob) ||
   empty($owner))

{
    return false;
}

$fields = [
    naam => urlencode($name),
    soort => urlencode($kind),
    geboortejaar => urlencode($dob),
    eigenaar_id => urlencode($owner)
];

api('dieren', true, $fields);

return true;