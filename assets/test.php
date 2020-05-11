<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'db/database.class.php';
require_once 'db/Poule/poule.inc.php';
require_once 'db/Poule/pouleAction.inc.php';

$poule = new pouleAction();
$db = new Database();

if($poule->createPoule(1, 'yeet')) {
	echo "ye: " . $poule->test();
} else {
	echo "noob";
}
