<?php require('./includes/utiles.php'); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Covid BD</title>
	<link rel="stylesheet" type="text/css" href="./bootstrap_4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="styles/main.css">
</head>

<body class="container vh-100">
	<div class="row centrer">

		<div class="col-sm"></div>
		<div id="formulaire" class="col-sm">
			<h1 class="display-2">Covid BD</h1>
			<form action="./includes/connexion.php" method="post">
				<div class="form-group">
					<input type="text" class="form-control" name="pseudo" placeholder="Pseudo" required>
					<input type="password" class="form-control" name="mdp" placeholder="Mot de passe" required>
					<button type="submit" id="confirmer" class="btn btn-primary">Se connecter</button>
				</div>
			</form>
			<div>
				<?php messageErreur(); ?>
			</div>
			<a href="inscription.php" id="inscription" class="link">Créer un compte</a>
		</div>
		<div class="col-sm"></div>
	</div>
</body>
</html>