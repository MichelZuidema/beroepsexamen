<?php
session_start();

require_once '../db/database.class.php';
require_once '../db/User/user.inc.php';
require_once '../db/User/userAction.inc.php';

$user = new userAction();

if(isset($_GET['user_id']) && isset($_GET['poule_id'])) {
	if(is_numeric($_GET['user_id']) && is_numeric($_GET['poule_id'])) {
		$user_id = filter_var($_GET['user_id'], FILTER_SANITIZE_NUMBER_INT);
		$poule_id = filter_var($_GET['poule_id'], FILTER_SANITIZE_NUMBER_INT);

		// Kijk of de gebruiker niet zichzelf probeert te verwijderen
		if($user_id != $_SESSION['user_id']) {
			if($user->deleteUserFromPoule($user_id, $poule_id)) {
				header('Location: ' . $_SERVER['HTTP_REFERER'] . "&mess=Gebruiker is van uw poule verwijderd!&color=green");
			} else {
				header('Location: ' . $_SERVER['HTTP_REFERER'] . "&mess=Er is iets foutgegaan!&color=red");
			}
		} else {
			header('Location: ' . $_SERVER['HTTP_REFERER'] . "&mess=U kunt uzelf niet verwijderen!&color=red");
		}
	}
}