<?
/**
 * Created by PhpStorm.
 * User: Owain
 * Date: 10/11/14
 * Time: 14:48
 */

require_once('../../../Keys.php');
require_once('api.php');

$firstname = $_POST['firstname'];
$affix = $_POST['affix'];
$lastname = $_POST['lastname'];
$residence = $_POST['residence'];

if(empty($firstname) ||
   empty($lastname) ||
   empty($residence))
{
    return false;
}

$fields = [
    voornaam => urlencode($firstname),
    tussenvoegsel => urlencode($affix),
    achternaam => urlencode($lastname),
    plaats => urlencode($residence)
];

api('eigenaars', true, $fields);

return true;