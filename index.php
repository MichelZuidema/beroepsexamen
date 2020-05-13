<?php
session_start();

// Kijk of de gebruiker is ingelogd
if(isset($_SESSION['user_id'])) {
	Header("Location: home.php");
}
?>
<!DOCTYPE html>
<html lang="nl">
	<head>
		<title>EK 2020 | Hoofdpagina</title>

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
					<h1>EK 2020 Uitslagen Voorspellen!</h1>

					<p id="banner-content">
						Welkom op de website EK 2020 Uitslagen Voorspellen. Op deze pagina kunt u met uw vriendengroep een poule aanmaken en daarin de landen selecteren waarvan jullie denkt dat die in de top 4 belanden. Veel success!
					</p>
				</div>
			</section>

			<section id="content">
				<div class="container">
					<div class="grid">
						<section id="create-poule">
							
							<h3>Creëer Poule</h3>
							<section id="create-poule-form" class="content-box">
								<form action="assets/proc/createPouleProcess.php" method="POST" name="createPoulePost">
									<div class="row">
										<div class="col-25">
											<label for="userPouleName">Poule Naam:</label>
										</div>

										<div class="col-75">
											<input type="text" id="userPouleName" name="userPouleName" placeholder="Poule Naam..." maxlength="60" required>
										</div>
									</div>

									<div class="row">
										<div class="col-25">
											<label for="fname">Naam:</label>
										</div>
										
										<div class="col-75">
											<input type="text" id="userName" name="userName" placeholder="Uw Naam..." maxlength="60">
										</div>
									</div>

									<div class="row">
										<div class="col-25">
											<label for="fname">E-Mail:</label>
										</div>
										
										<div class="col-75">
											<input type="email" id="userEmail" name="userEmail" placeholder="Uw Email..." maxlength="100" required>
										</div>
									</div>

									<div class="row">
								    	<input type="submit" value="Submit" name="submitPoule">
								  	</div>
								</form>
							</section>
						</section>

						<section id="form">
							<h3>Login</h3>
							<section id="login-form" class="content-box">
								<form action="assets/proc/loginProcess.php" method="POST" name="loginPost">
									<div class="row">
										<div class="col-25">
											<label for="userEmail">E-Mail:</label>
										</div>

										<div class="col-75">
											<input type="email" name="userEmail" placeholder="Uw email..." required>
										</div>
									</div>

									<div class="row">
										<div class="col-25">
											<label for="fname">Wachtwoord:</label>
										</div>
										
										<div class="col-75">
											<input type="password" id="userPassword" name="userPassword" placeholder="Uw wachtwoord..." required>
										</div>
									</div>

									<div class="row">
								    	<input type="submit" value="Submit" name="submitLogin">
								  	</div>
								</form>
							</section>
						</section>
					</div>
				</div>
			</section>
		</main>
	</body>
</html>