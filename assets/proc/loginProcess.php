<?php

require_once '../db/database.class.php';
require_once '../db/User/user.inc.php';
require_once '../db/User/userAction.inc.php';

$user = new userAction();
session_start();

if(isset($_POST['submitLogin'])) {
	if(isset($_POST['userEmail']) && isset($_POST['userPassword'])) {
		$username = filter_var($_POST['userEmail'], FILTER_SANITIZE_STRING);
		$password = filter_var($_POST['userPassword'], FILTER_SANITIZE_STRING);

		if($user->authenticateUser($username, $password)) {
			Header("Location: ../../home.php");
		} else {
			Header("Location:../../index.php?mess=Verkeerd email en / of wachtwoord! Probeer het opnieuw!&color=red");
		}
	}
}

?>