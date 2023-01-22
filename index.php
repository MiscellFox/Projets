<?php
	if (isset($_GET["Verifier"]) && !empty($_GET))
	{
		$Verifier = $_GET["Verifier"];
	}
	else {
		$Verifier = "";
	}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Animated Login Form</title>
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<script src="https://code.iconify.design/iconify-icon/1.0.2/iconify-icon.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


	<!-- Bouton verifier script -->
	<?php if ($Verifier == "Conforme") : ?>
		<script>
			swal({
				title: "Votre enregistrement a déjà été effectué !",
				icon: "success",
				button: "Compris !",				
			})
			.then((value) => {
				swal({
				title: "Allez a la reference ?",
				buttons: true,
				dangerMode: true,
				})
				.then((Reponse) => {
				if (Reponse) {
					window.location = "php/Liste.php";
				} else {
					window.location = "index.php";
				}
				});

			});
		</script>
	<?php endif ?>
	<?php if ($Verifier == "NConforme") : ?>
		<script>
			swal({
				title: "Vous ne vous ètes pas encore enregistrer !",
				text: "",
				icon: "error",
				button: "Compris !",
			});
		</script>
	<?php endif ?>
	

	<header>
		<div class="logo">
			<img src="Image/AWS-Cloud-1.png" alt="logo" class="image">
			<a href="#">Amazon Service Cloud</a>
		</div>
		<a class="signin-button" href="php/Liste.php">
			<!-- <iconify-icon icon="material-symbols:home-outline-rounded"></iconify-icon> -->
			Participants
		</a>
	</header>
<section class="first">

	<main class="informations">
		<div class="left-container">
			<div class="message">
				Bienvenue sur le site de Simplon CI. Il a été crée dans le but de pouvoir 
				enregistrer à titre de présence tous les candidats ou participants
				ayant postulés a simplon pour la formation AWS cloud (Amazon Service cloud).
				Veillez donc remplir le formulaire pour faire acte de présence auprès de Simplon CI.
			</div>
			<div class="message">
				Simplon.co est un réseau de fabriques solidaires et inclusives qui propose des formations
				gratuites aux métiers du numérique. Implantés un peu partout dans le monde entier son siège 
				social est basé en France. Cette école du numérique révèle les talents éloignés de l’emploi 
				avec pour atout principal la passion du numérique, issus très souvent de milieu en difficulté.
				Pour plus d'information voir le site officiel de Simplon à l'adresse ci-dessous.
			</div>
			<div class="link-to-Simplon">
				<button>
					<a href="http://simplon.ci/" target="_blank" rel="noopener noreferrer">En savoir plus</a>
				</button>
			</div>
		</div>
	
	</main>
	<main class="general-form">
		<div class="box">
			<form action="php/Traitement.php" method="POST" autocomplete="off">
				<h2>Sign UP</h2>
				<div class="inputBox">
					<input type="text" name="Nom" required="required">
					<span>Last Name</span>
					<i></i>
				</div>
				<div class="inputBox">
					<input type="text" name="Prenom" required="required">
					<span>First Name</span>
					<i></i>
				</div>
				<div class="inputBox">
					<input type="tel" name="Telephone" pattern="[0-9]{10}" required="required">
					<span>Phone</span>
					<i></i>
				</div>
				<div class="inputBox">
					<input type="email" name="Email" required="required">
					<span>Email</span>
					<i></i>
				</div>

				<!-- Button animation Login -->
				<div class="buttons">

					<button class="blob-btn" id="login" name="Verifier">
						Verifier
						<span class="blob-btn__inner">
							<span class="blob-btn__blobs">
								<span class="blob-btn__blob"></span>
								<span class="blob-btn__blob"></span>
								<span class="blob-btn__blob"></span>
								<span class="blob-btn__blob"></span>
							</span>
						</span>
					</button>

					<button class="blob-btn-signup" id="signup" name="Valider">
						Valider
						<span class="blob-btn__inner">
							<span class="blob-btn__blobs">
								<span class="blob-btn__blob"></span>
								<span class="blob-btn__blob"></span>
								<span class="blob-btn__blob"></span>
								<span class="blob-btn__blob"></span>
							</span>
						</span>
					</button>

					<svg xmlns="http://www.w3.org/2000/svg" version="1.1">
						<defs>
							<filter id="goo">
								<feGaussianBlur in="SourceGraphic" result="blur" stdDeviation="10"></feGaussianBlur>
								<feColorMatrix in="blur" mode="matrix"
									values="1 0 0 0 0 0 1 0 0 0 0 0 1 0 0 0 0 0 21 -7" result="goo"></feColorMatrix>
								<feBlend in2="goo" in="SourceGraphic" result="mix"></feBlend>
							</filter>
						</defs>
					</svg>
				</div>

			</form>
		</div>
	</main>
</section>

</body>

</html>