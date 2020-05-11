<?php

require_once 'assets/db/database.class.php';
require_once 'assets/db/User/user.inc.php';
require_once 'assets/db/User/userAction.inc.php';
session_start();

$user = new userAction();

if($user->isUserAuthenticated()) {
	echo "Welcome, " . $_SESSION['user_name'];
}

?>