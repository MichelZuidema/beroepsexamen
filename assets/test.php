<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'db/database.class.php';
require_once 'db/Poule/poule.inc.php';
require_once 'db/Poule/pouleAction.inc.php';
require_once 'db/User/user.inc.php';
require_once 'db/User/userAction.inc.php';
require_once 'db/Country/country.inc.php';
require_once 'db/Country/countryAction.inc.php';
require_once 'mailEvent.class.php';

// $poule = new pouleAction();
// echo '<pre>';
$array = $poule->showAllUsersForPoule(35);
// print_r($array);

$string = "";
foreach($array as $arr) {
	$string .= $arr['user_email'] . ", ";

}

echo "test" . $string;

$mail = new mailEvent("sjarreldevis@gmail.com, milanvried@gmail.com,", "title", "yeeet");
$mail->sendMail();