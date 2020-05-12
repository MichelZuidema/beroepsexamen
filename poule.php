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

$userAction = new userAction();
$poule = new pouleAction();
$countryAction = new countryAction();

if(!$userAction->isUserAuthenticated()) {
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
					<section class="poule">
						<div class="container">
							<h1><?php echo $poule->showPouleName($id); ?></h1>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae incidunt architecto nobis iusto modi, accusamus pariatur. Fugit nobis voluptates reprehenderit neque sunt eligendi, quas doloribus eius facilis totam laborum odio!</p>
							
							<form action="assets/proc/countrySelectProcess.php" method="POST">
								<div id="poule-country-grid">
									<?php 
										for($i = 1; $i < 5; $i++) {
											$currentCountry = $poule->getSelectedCountry($_SESSION['user_id'], $id, $i)[0]["user_sel_country_$i"];
											echo "Plaats: " . $i;
											echo "<select name='country-" . $i . "'>";
											echo "<option value='0'>Selecteer een optie</option>";

											foreach($countryAction->countryList() as $country) {
												echo "<option value='" . $country['country_id'] . "'";

												if($currentCountry == $country['country_id']) {
													echo "selected";
												} 

												echo ">";
												echo $country['country_name'];
												echo "</option>";
											}
											echo "</select>";
										}

									?>
								</div>
								<input type="hidden" name="pouleId" value="<?php echo $id; ?>">
								<input type="submit" value="Opslaan" name="submitLogin" id="poule-country-btn">
							</form>

							<?php if($poule->isPouleAdmin($id, $_SESSION['user_id'])) : ?>
								<div id="poule-correct-country">
									<h2>Vul hier de correcte antwoorden in:</h2>
									<form action="assets/proc/correctCountrySelectProcess.php" method="POST">
										<div id="poule-country-grid">
											<?php 
												for($i = 1; $i < 5; $i++) {
													$currentCountry = $countryAction->getCorrectCountry($i, $id)[0]["correct_country_id_$i"];
													echo "Plaats: " . $i;
													echo "<select name='correct_country_id_" . $i . "'>";
													echo "<option value='0'>Selecteer een optie</option>";

													foreach($countryAction->countryList() as $country) {
														echo "<option value='" . $country['country_id'] . "'";

														if($currentCountry == $country['country_id']) {
															echo "selected";
														} 

														echo ">";
														echo $country['country_name'];
														echo "</option>";
													}
													echo "</select>";
												}

											?>
										</div>
										<input type="hidden" name="pouleId" value="<?php echo $id; ?>">
										<input type="submit" value="Opslaan" name="submitLogin" id="poule-country-btn">
									</form>
							<?php endif; ?>

							<div id="poule-table">
								<h2>Poule Leden:</h2>
								<ul>
									<?php foreach($poule->showAllUsersForPoule($id) as $user) : ?>
										<li><?php echo $user['user_name']; ?>, <?= $userAction->pointsOfUser($user['user_id'], $id)[0]['points']; ?> Punten
										<?php if($poule->isPouleAdmin($id, $_SESSION['user_id'])) : ?>
											- <a href="assets/proc/deleteMember.php?user_id=<?php echo $user['user_id']; ?>&poule_id=<?php echo $id; ?>">Verwijderen</a></li>
										<?php endif; ?>
									<?php endforeach; ?>
								</ul>
							</div>
						</div>
					</section>
				</div>
			</section>
		</main>
	</body>
</html>