<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../db/database.class.php';
require_once '../db/User/user.inc.php';
require_once '../db/User/userAction.inc.php';
require_once '../db/Poule/poule.inc.php';
require_once '../db/Poule/pouleAction.inc.php';

$user = new userAction();
$poule = new pouleAction();

if(isset($_POST['submitNewMember'])) {
	if(isset($_POST['userEmail']) && isset($_POST['pouleId'])) {
		$email = filter_var($_POST['userEmail'], FILTER_SANITIZE_EMAIL);
		$pouleId = filter_var($_POST['pouleId'], FILTER_SANITIZE_NUMBER_INT);

		$password = "geheim";

		if($user->doesUserExistWithEmail($email)) {
			if($poule->addUserToPoule($user->idOfUserByEmail($email)[0]['user_id'], $pouleId)) {
				Header("Location:../../poule.php?pouleId=$pouleId&mess=De gebruiker is toegevoegt aan uw poule!&color=green");
			}
		} else {
			if($user->createUser($email, password_hash($password, PASSWORD_DEFAULT))) {
				if($poule->addUserToPoule($user->idOfUserByEmail($email)[0]['user_id'], $pouleId)) {
					Header("Location:../../poule.php?pouleId=$pouleId&mess=De gebruiker is toegevoegt aan uw poule!&color=green");
				}
			} else {
				Header("Location:../../poule.php?pouleId=$pouleId&mess=Er is iets foutgegaan! Probeer het opnieuw&color=red");
			}
		}

	}
}
?>