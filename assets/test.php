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

$db = new Database();
$poule = new pouleAction();
$user = new userAction();
$country = new countryAction();

echo '<pre>';
print_r($country->countryList());
