<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Covid BD</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="./styles/main.css">
	<link rel="stylesheet" type="text/css" href="./bootstrap_4.5.0/css/bootstrap.css">
	<link rel="shortcut icon" href="images/logo_IWS.ico">
</head>

<body class="container-fluid">
	<main class="row">
		<h2 class="col-12" id="titreInscription">Voulez-vous vraiment supprimer votre compte ?</h2>
		<form class="offset-md-2 offset-lg-4 col-12 col-md-8 col-lg-4" method="post" action="includes/suppression.php">
			<div class="form-group row">
				<label class="col-lg-3 col-form-label" for="login">Pseudo :</label>
				<div class="col-lg-9">
					<input class="form-control" type="text" name="pseudo" id="login" required/>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-lg-3 col-form-label" for="password">Mot de passe :</label>
				<div class="col-lg-9">
					<input class="form-control" type="password" name="mdp" id="password" required="true" />
				</div>
			</div>
			<div class="form-group row justify-content-center">
				<div class="col-12 d-flex justify-content-center">
					<input class="btn btn-danger btn-large" id="valider" type="submit" name="changeBouton" value="Supprimer">
				</div>
			</div>
		</form>
		<div class="offset-md-2 offset-lg-4"></div>
		<div class="col-12" id="inscription-back-button">
			<a class="btn btn-secondary" href="./accueil.php">Annuler</a>
		</div>
	</main>
</body>
</html>