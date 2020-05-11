<?php

if(isset($_SESSION['user_id'])) {
	echo "Hello, " . $_SESSION['user_name'];
} else {
	echo "No Session.";
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
					<div class="grid">
						<section id="create-poule">
							<h3>Creeer Poule</h3>
							<section id="create-poule-form" class="content-box">
								<form action="assets/proc/createPouleProcess.php" method="POST" name="createPoulePost">
									<div class="row">
										<div class="col-25">
											<label for="userPouleName">Poule Naam:</label>
										</div>

										<div class="col-75">
											<input type="text" id="userPouleName" name="userPouleName" placeholder="Poule Naam..." maxlength="60" required="true">
										</div>
									</div>

									<div class="row">
										<div class="col-25">
											<label for="fname">Naam:</label>
										</div>
										
										<div class="col-75">
											<input type="text" id="userName" name="userName" placeholder="Uw Naam..." maxlength="60" required="true">
										</div>
									</div>

									<div class="row">
										<div class="col-25">
											<label for="fname">E-Mail:</label>
										</div>
										
										<div class="col-75">
											<input type="email" id="userEmail" name="userEmail" placeholder="Uw Email..." maxlength="100" required="true">
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
											<input type="text" id="userEmail" name="userEmail" placeholder="Uw email..." required="true">
										</div>
									</div>

									<div class="row">
										<div class="col-25">
											<label for="fname">Wachtwoord:</label>
										</div>
										
										<div class="col-75">
											<input type="password" id="userPassword" name="userPassword" placeholder="Uw wachtwoord..." required="true">
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