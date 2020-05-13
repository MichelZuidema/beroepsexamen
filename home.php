<?php
session_start();
// Gebruikte classes
require_once 'assets/db/database.class.php';
require_once 'assets/db/User/user.inc.php';
require_once 'assets/db/User/userAction.inc.php';
require_once 'assets/db/Poule/poule.inc.php';
require_once 'assets/db/Poule/pouleAction.inc.php';

$user = new userAction();
$pouleAction = new pouleAction();

// Kijk of de gebruiker is ingelogd
if(!$user->isUserAuthenticated()) {
	Header("Location: index.php");
}

?>
<!DOCTYPE html>
<html lang="nl">
	<head>
		<title>EK 2020 Voorspellen.</title>

		<!-- Meta Tags -->
		<meta charset="UTF-8">

		<!-- Stylesheet -->
		<link rel="Stylesheet" href="assets/css/main.css">
	</head>
	<body>
		<?php require_once 'assets/inc/header.php'; ?>

		<main>
			<?php require_once 'assets/inc/message.php'; ?>

			<section id="banner">
				<div class="container">
					<h1>E.K. 2020 Uitslagen Voorspellen!</h1>

					<p id="banner-content">
						Op deze pagina kunt u de poules zien waar u aan mee doet. Ziet u er geen? Dan moet u er een aanmaken of aan een meedoen.
					</p>
				</div>
			</section>

			<section id="content">
				<div class="container">
					<div class="grid-poule">
						<?php 
							$data = $pouleAction->showAllPoulesForUser($_SESSION['user_id']);
							
							// Kijk of er daadwerkelijk poules gevonden zijn voor de gebruiker
							if($data != "empty") {
								foreach($pouleAction->showAllPoulesForUser($_SESSION['user_id']) as $poule) {
									echo '<button class="poule-btn">';
									echo '<a href="poule.php?pouleId=' . $poule['poule_id'] . '">' . $poule['poule_name'] .'</a>';
									echo '</a>';
								}
							} else {
								echo "Er zijn geen poules voor u gevonden!";
							}
						?>
					</div>
				</div>
			</section>
		</main>
	</body>
</html>