<?php

require_once '../db/database.class.php';
require_once '../db/Poule/poule.inc.php';
require_once '../db/Poule/pouleAction.inc.php';
require_once '../db/User/user.inc.php';
require_once '../db/User/userAction.inc.php';

$user = new userAction();
$poule = new pouleAction();

if(isset($_POST['submitPoule'])) {
	if(isset($_POST['userPouleName']) && isset($_POST['userName']) && isset($_POST['userEmail'])) {
		$pouleName = filter_var($_POST['userPouleName'], FILTER_SANITIZE_STRING);
		$userName = filter_var($_POST['userName'], FILTER_SANITIZE_STRING);
		$userEmail = filter_var($_POST['userEmail'], FILTER_SANITIZE_EMAIL);

		$password = "geheim";

		if($user->createPouleAdministrator($userName, $userEmail, password_hash($password, PASSWORD_DEFAULT))) {
			if($user->authenticateUser($userEmail, $password)) {
				if($poule->createPoule($_SESSION['user_id'], $pouleName)) {
					if($poule->addUserToPoule($_SESSION['user_id'], $poule->lastPouleId())) {
						echo "yass ladss";
					} else {
						echo "error, adding user to poule";
					}
				} else {
					echo "error, creating poule";
				}
			} else {
				echo "error, authentication";
			}
		} else {
			echo "error, creating admin";
		}
	} else {
		echo "empty stuff";
	}
} else {
	echo "empty";
}

?>