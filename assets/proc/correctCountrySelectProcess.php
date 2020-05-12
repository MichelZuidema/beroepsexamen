<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../db/database.class.php';
require_once '../db/Country/country.inc.php';
require_once '../db/Country/countryAction.inc.php';

$country = new countryAction();

if(isset($_POST['submitLogin'])) {
	for($i = 1; $i < 5; $i++)
	{
		$var = "correct_country_id_" . $i;
		$pouleId = $_POST['pouleId'];
		if(isset($_POST[$var])) {
			if($_POST[$var] != '0') {
				if($country->setCorrectCountry($i, $_POST[$var], $pouleId)) {
					Header("Location:../../poule.php?pouleId=$pouleId&mess=De correcte landen zijn ingevuld!&color=green");
				} else {
					Header("Location:../../poule.php?pouleId=$pouleId&mess=Er is iets foutgegaan bij het aanpassen de correcte landen!!&color=red");
				}
			}
		} else {
			Header("Location:../../poule.php?pouleId=$pouleId&mess=Er is iets foutgegaan! Probeer het opnieuw!&color=red");
		}
	}
}

?>