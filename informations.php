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
</head>

<body class="container-fluid">
	<main class="row ligne">
		<h2 class="col-12" id="titreInscription">Mes informations</h2>
		<form class="offset-md-2 offset-lg-4 col-12 col-md-8 col-lg-4" method="post" action="includes/modifInfo.php">
			<div class="form-group row">
				<label class="col-lg-3 col-form-label" for="login">Pseudo :</label>
				<div class="col-lg-9">
					<input class="form-control" type="text" name="pseudo" value="<?php echo $_SESSION['pseudo']; ?>" required/>
				</div>
			</div>
			<div class="form-group row ligne">
				<label class="col-lg-3 col-form-label" for="email">Email : </label>
				<div class="col-lg-9">
					<input class="form-control" type="mail" name="email" value="<?php echo $_SESSION['email']; ?>" required/>
				</div>
			</div>
			<div class="form-group row justify-content-center ligne">
				<div class="col-12 d-flex justify-content-center">
					<input class="btn btn-primary btn-large" id="valider" type="submit" name="changeBouton" value="Valider">
				</div>
			</div>
		</form>
		<div class="offset-md-2 offset-lg-4"></div>
	</main>
	<div class="row ligne">
		<div class="col-sm d-flex justify-content-center">
			<a href="./suppression.php" class="btn btn-danger btn-large" id="supprimer">Supprimer mon compte</a>
		</div>
	</div>
</body>
</html>
