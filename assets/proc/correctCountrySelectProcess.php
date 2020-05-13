<?php
session_start();
require_once '../db/database.class.php';
require_once '../db/Country/country.inc.php';
require_once '../db/Country/countryAction.inc.php';
require_once '../db/Poule/poule.inc.php';
require_once '../db/Poule/pouleAction.inc.php';
require_once '../mailEvent.class.php';
require_once '../inc/functions.php';

$country = new countryAction();
$poule = new pouleAction();

// Is de POST request verstuurd vanaf de goede knop
if(isset($_POST['submitLogin'])) {
	for($i = 1; $i < 5; $i++) {
		$var = "correct_country_id_" . $i;
		$pouleId = $_POST['pouleId'];

		// Als het correcte land is ingevuld
		if(isset($_POST[$var])) {
			if($_POST[$var] != '0') {
				// Zet de correcte landen in de database en wijzig daarna de punten
				if($country->setCorrectCountry($i, $_POST[$var], $pouleId)) {
					$poule->updatePointsForPoule($pouleId);
					Header("Location:../../poule.php?pouleId=$pouleId&mess=De correcte landen zijn ingevuld en de punten zijn aangepast!&color=green");
				} else {
					Header("Location:../../poule.php?pouleId=$pouleId&mess=Er is iets foutgegaan bij het aanpassen de correcte landen!!&color=red");
					exit;
				}
			}
		} else {
			Header("Location:../../poule.php?pouleId=$pouleId&mess=Er is iets foutgegaan! Probeer het opnieuw!&color=red");
			exit;
		}
	}

	// Email naar de pouleleden met de uitslag
	$emailContent = "Beste gebruiker, de administrator van uw poule heeft de correcte landen ingevuld! Dit zijn de uitslagen: ";
	$members = sortArrayOnPoints($poule->showAllUsersForPoule($pouleId)); 

	foreach($members as $key => $member) {
		$count = $key + 1;
		$emailContent .= "Plaats: " . $count . ": " . $member['user_email'] . " met " . $member['points'];

		if($member['points'] == 1) { 
			$emailContent .= " punt. ";
		} else { 
			$emailContent .= " punten. ";
		}
	}

	// Verstuur mail doormiddel van de mailEvent class
	$mail = new mailEvent(null, "De correcte landen van uw poule zijn ingevuld!", $emailContent);
	$mail->addReceiverEmailList($users = $poule->showAllUsersForPoule($pouleId));
	$mail->sendMail();
}

?>