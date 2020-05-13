<?php
session_start();

require_once '../db/database.class.php';
require_once '../db/User/user.inc.php';
require_once '../db/User/userAction.inc.php';
require_once '../db/Poule/poule.inc.php';
require_once '../db/Poule/pouleAction.inc.php';

$user = new userAction();
$poule = new pouleAction();

if(isset($_POST['submitLogin'])) {
	// Loop over de 4 land columns heen
	for($i = 1; $i < 5; $i++)
	{
		$var = "country-" . $i;
		$pouleId = $_POST['pouleId'];
		if(isset($_POST[$var])) {
			if($_POST[$var] != '0') {
				// Zet de geselecteerde landen in de database
				if($user->setSelectedCountry($i, $_POST[$var], $_SESSION['user_id'], $pouleId)) {
					$poule->updatePointsForPoule($pouleId);
					Header("Location:../../poule.php?pouleId=$pouleId&mess=Uw Geselecteerde Landen Zijn Aangepast!&color=green");
				} else {
					Header("Location:../../poule.php?pouleId=$pouleId&mess=Er is iets foutgegaan bij het aanpassen van uw geselecteerde landen!&color=red");
				}
			}
		} else {
			Header("Location:../../poule.php?pouleId=$pouleId&mess=Er is iets foutgegaan! Probeer het opnieuw!&color=red");
		}
	}

	Header("Location:../../poule.php?pouleId=$pouleId&mess=Er is iets foutgegaan! Probeer het opnieuw!&color=red");
}

?>