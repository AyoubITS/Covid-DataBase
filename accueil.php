<?php
	require './includes/utiles.php';
	session_start();
	$conn_string = "host=postgresql-covid-bd.alwaysdata.net port=5432 dbname=covid-bd_postgresql user=covid-bd password=Ucp2020=";
	$dbconn = pg_pconnect($conn_string);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<title>Covid BD</title>
	<link rel="stylesheet" type="text/css" href="./bootstrap_4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="styles/main.css">
	<script type="text/javascript" src="./worldmap/mapdata.js"></script>
	<script type="text/javascript" src="./worldmap/worldmap.js"></script>
</head>

<body class="container-fluid vh-100 justify-content-center">
	<div class="row titre">
		<div class="col-sm">
			<h1 class="centrer">Bienvenue <?php echo $_SESSION['pseudo']; ?></h1>
		</div>
	</div>
	<div class="row d-flex justify-content-around">
		<span class="infoPays">Dans le monde :</span>
		<?php 
			if ($dbconn) {	
				$sql = "SELECT * FROM monde;";
				$result = pg_query($dbconn, $sql);
				$confirmé = pg_fetch_result($result, 0, 1);
				echo "<span class = \"casMonde\">Confirmés : ", $confirmé, "      </span>";
				$guerri = pg_fetch_result($result, 0, 2);
				echo "<span class = \"guerisMonde\">Guerris : ", $guerri, "       </span>";
				$morts = pg_fetch_result($result, 0, 3);
				echo "<span class = \"mortsMonde\">Morts : ", $morts, "       </span>";
			}
			else {
				echo "Connexion a la base de données impossible actuellement";
			}
			?>
	</div>
	<div class="row d-flex justify-content-between ligne">
		<div class = "col-9" id="map"></div>
		<div class="col-3">
			<h4>Pays que vous avez déjà consulter :</h4>
			<?php getPays($dbconn); ?>
		</div>
	</div>
	</div>
	<div class="row ligne">
		<div class="col-sm d-flex justify-content-center">
			<a href="./informations.php" class="btn btn-info">Mes informations</a>
		</div>
	</div>
	<div class="row ligne">
		<div class="col-sm d-flex justify-content-center">
			<a href="./includes/deconnexion.php" class="btn btn-danger">Deconnexion</a>
		</div>
	</div>
</body>

</html>