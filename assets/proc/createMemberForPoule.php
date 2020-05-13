<?php
require_once '../db/database.class.php';
require_once '../db/User/user.inc.php';
require_once '../db/User/userAction.inc.php';
require_once '../db/Poule/poule.inc.php';
require_once '../db/Poule/pouleAction.inc.php';
require_once '../mailEvent.class.php';
require_once '../inc/functions.php';

$user = new userAction();
$poule = new pouleAction();

if(isset($_POST['submitNewMember'])) {
	if(isset($_POST['userEmail']) && isset($_POST['pouleId'])) {
		$email = filter_var($_POST['userEmail'], FILTER_SANITIZE_EMAIL);
		$pouleId = filter_var($_POST['pouleId'], FILTER_SANITIZE_NUMBER_INT);

		// Genereer random wachtwoord
		$password = generateRandomString(15);

		// Als er al een gebruiker bestaat met dat email, voeg deze dan toe aan de poule
		if($user->doesUserExistWithEmail($email)) {
			if($poule->addUserToPoule($user->idOfUserByEmail($email)[0]['user_id'], $pouleId)) {
				$emailContent = "Beste meneer of Mevrouw, u is zojuist toegevoegd aan een nieuwe poule! U kunt deze vinden op de hoofdpagina! ( https://83239.ict-lab.nl/ex83239/ ) ";
				$emailContent .= "Met vriendelijke groet.";

				$mail = new mailEvent($email, "U bent toegevoegd aan een poule!", $emailContent);
				$mail->sendMail();
				Header("Location:../../poule.php?pouleId=$pouleId&mess=De gebruiker is toegevoegt aan uw poule!&color=green");
			}
		} else {
			if($user->createUser($email, password_hash($password, PASSWORD_DEFAULT))) {
				if($poule->addUserToPoule($user->idOfUserByEmail($email)[0]['user_id'], $pouleId)) {
				Header("Location:../../poule.php?pouleId=$pouleId&mess=De gebruiker is toegevoegt aan uw poule!&color=green");

				$emailContent = "Beste meneer of Mevrouw, u is zojuist toegevoegd aan een nieuwe poule! U kunt deze poule vinden door in te loggen op de volgende website: https://83239.ict-lab.nl/ex83239/ met de volgende gegevens: ";
				$emailContent .= "E-Mail: " . $email . ", Wachtwoord: " . $password;
				$emailContent .= " Met vriendelijke groet.";

				$mail = new mailEvent($email, "U bent toegevoegd aan een poule!", $emailContent);
				$mail->sendMail();
				}
			} else {
				Header("Location:../../poule.php?pouleId=$pouleId&mess=Er is iets foutgegaan! Probeer het opnieuw&color=red");
			}
		}

	}
}
?>