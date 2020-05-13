<?php
session_start();

// Gebruikte classes
require_once 'assets/db/database.class.php';
require_once 'assets/db/User/user.inc.php';
require_once 'assets/db/User/userAction.inc.php';
require_once 'assets/db/Poule/poule.inc.php';
require_once 'assets/db/Poule/pouleAction.inc.php';
require_once 'assets/db/Country/country.inc.php';
require_once 'assets/db/Country/countryAction.inc.php';
require_once 'assets/inc/functions.php';

$userAction = new userAction();
$poule = new pouleAction();
$countryAction = new countryAction();

// Kijk of de gebruiker is ingelogd
if(!$userAction->isUserAuthenticated()) {
	Header("Location: index.php");
}

// Kijk en filter naar de poule id in de URL
if($_GET['pouleId'] != null) {
	$id = htmlspecialchars($_GET['pouleId'], ENT_QUOTES, 'UTF-8');
} else {
	Header("Location: home.php?mess=Er is iets foutgegaan bij het inladen van de poule, probeer het opnieuw!&color=red");
}

?>
<!DOCTYPE html>
<html lang="nl">
	<head>
		<title>EK 2020 | Poule</title>

		<!-- Meta Tags -->
		<meta charset="UTF-8">
		<meta name="description" content="Raad de uitslagen met jouw vriendengroep!">
		<meta name="keywords" content="voetbal, ek, ek2020, 2020, vriendengroep, uitslagen, raden">

		<!-- Stylesheet -->
		<link rel="Stylesheet" href="assets/css/main.css">
	</head>
	<body>

		<?php require_once 'assets/inc/header.php'; ?>

		<main>
			<!-- Eventuele errors / berichten -->
			<?php require_once 'assets/inc/message.php'; ?>

			<section id="banner">
				<div class="container">
					<h1>E.K. 2020 Uitslagen Voorspellen!</h1>

					<p id="banner-content">
						Dit is de pagina van uw poule. Op deze pagina kunt u de landen selecteren waarvan u denkt dat zij op die plek komen. Als administrator van deze pagina kunt u de correcte landen invoeren, leden verwijderen en leden toevoegen.
					</p>
				</div>
			</section>

			<section id="content">
				<div class="container">
					<section class="poule">
						<div class="container">
							<h1>Poule: <?= $poule->showPouleName($id); ?></h1>
							
							<h2>Selecteer hier uw landen:</h2>
							<form action="assets/proc/countrySelectProcess.php" method="POST">
								<div id="poule-country-grid">
									<?php 
										// Loop over de 4 landen
										for($i = 1; $i < 5; $i++) {
											$currentCountry = $poule->getSelectedCountry($_SESSION['user_id'], $id, $i)[0]["user_sel_country_$i"];
											echo "Plaats: " . $i;
											echo "<select name='country-" . $i . "'>";
											echo "<option value='0'>Selecteer een optie</option>";

											// Laat alle landen zien vanuit de database
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
							
							<!-- Correcte landen, alleen voor administrators -->
							<?php if($poule->isPouleAdmin($id, $_SESSION['user_id'])) : ?>
								<div id="poule-correct-country">
									<h2>Selecteer hier de correcte antwoorden in:</h2>
									<form action="assets/proc/correctCountrySelectProcess.php" method="POST">
										<div id="poule-country-grid">
											<?php 
												// Loop over de 4 landen
												for($i = 1; $i < 5; $i++) {
													$currentCountry = $countryAction->getCorrectCountry($i, $id)[0]["correct_country_id_$i"];

													echo "Plaats: " . $i;
													echo "<select name='correct_country_id_" . $i . "'>";
													echo "<option value='0'>Selecteer een optie</option>";

													// Laat alle landen zien vanuit de database
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
										<li><?php echo $user['user_email']; ?>

										<?php if($poule->isPouleAdmin($id, $user['user_id'])) : ?>
											- Administrator
										<?php endif; ?>

										<?php if($poule->isPouleAdmin($id, $_SESSION['user_id'])) : ?>
											- <a href="assets/proc/deleteMember.php?user_id=<?php echo $user['user_id']; ?>&poule_id=<?php echo $id; ?>">Verwijderen</a></li>
										<?php endif; ?>
									<?php endforeach; ?>
								</ul>
								<?php if($poule->areCorrectCountriesFilled($id)) : ?>
								<h3>Uitslagen!</h3>
								<ul>
									<?php $members = sortArrayOnPoints($poule->showAllUsersForPoule($id)); foreach($members as $key => $member) : ?>
										<li>Plaats: <?= $key + 1; ?>: <?= $member['user_email']; ?> met <?= $member['points']; if($member['points'] == 1) { echo " punt"; } else { echo " punten"; }?>.</li>
									<?php endforeach; ?>
								</ul>
								<?php endif; ?>
							</div>
							
							<?php if($poule->isPouleAdmin($id, $_SESSION['user_id'])) : ?>
								<h2>Nieuw Lid Toevoegen:</h2>
								<form action="assets/proc/createMemberForPoule.php" method="POST" name="createPoulePost">
									<div class="row">
										<div class="col-25">
											<label for="userPouleName">E-Mail:</label>
										</div>

										<div class="col-75">
											<input type="email" id="userEmail" name="userEmail" placeholder="E-Mail..." maxlength="100" required="true">
										</div>
									</div>

									<div class="row">
								    	<input type="submit" value="Toevoegen!" name="submitNewMember">
								  	</div>

								  	<input type="hidden" name="pouleId" value="<?= $id ?>">
								</form>
							<?php endif; ?>
						</div>
					</section>
				</div>
			</section>
		</main>
	</body>
</html>