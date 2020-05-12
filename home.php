<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once 'assets/db/database.class.php';
require_once 'assets/db/User/user.inc.php';
require_once 'assets/db/User/userAction.inc.php';
require_once 'assets/db/Poule/poule.inc.php';
require_once 'assets/db/Poule/pouleAction.inc.php';

$user = new userAction();
$pouleAction = new pouleAction();

if(!$user->isUserAuthenticated()) {
	Header("Location: index.php");
}

?>
<html>
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
						Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione in, fuga aliquid illo, porro quia dolorem itaque. Harum quis exercitationem nobis adipisci excepturi itaque ipsa amet ipsum est. Ullam, architecto.
					</p>
				</div>
			</section>

			<section id="content">
				<div class="container">
					<div class="grid-poule">
					

						<?php 
							$data[] = $pouleAction->showAllPoulesForUser($_SESSION['user_id']);
							if(!empty($data)) {
								foreach($pouleAction->showAllPoulesForUser($_SESSION['user_id']) as $poule) {
									echo '<button class="poule-btn">';
									echo '<a href="poule.php?pouleId=' . $poule['poule_id'] . '">' . $poule['poule_name'] .'</a>';
									echo '</a>';
								}
							} else {
								echo "No poules found fur ye";
							}
						?>
					</div>
				</div>
			</section>
		</main>
	</body>
</html>