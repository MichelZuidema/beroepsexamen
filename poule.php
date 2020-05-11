<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'assets/db/database.class.php';
require_once 'assets/db/User/user.inc.php';
require_once 'assets/db/User/userAction.inc.php';
require_once 'assets/db/Poule/poule.inc.php';
require_once 'assets/db/Poule/pouleAction.inc.php';
require_once 'assets/db/Country/country.inc.php';
require_once 'assets/db/Country/countryAction.inc.php';
session_start();

$user = new userAction();
$poule = new pouleAction();
$countryAction = new countryAction();

if(!$user->isUserAuthenticated()) {
	Header("Location: index.php");
}

$id = $_GET['pouleId'];

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
					<section class="poule">
						<div class="container">
							<h1><?php echo $poule->showPouleName($id); ?></h1>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae incidunt architecto nobis iusto modi, accusamus pariatur. Fugit nobis voluptates reprehenderit neque sunt eligendi, quas doloribus eius facilis totam laborum odio!</p>

							<div id="poule-country-grid">
								<?php 
									for($i = 0; $i < 4; $i++) {
										echo "Land: " . $i;
										echo "<select>";
										echo "<option value='0'>Selecteer een optie</option>";
										foreach($countryAction->countryList() as $country) {
											echo "<option value='0'>" . $country['country_name'] . "</option>";
										}
										echo "</select>";
									}
								?>
							</div>
							<input type="submit" value="Submit" name="submitLogin" id="poule-country-btn">
						</div>
					</section>
				</div>
			</section>
		</main>
	</body>
</html>