<?php

session_start();

$conn_string = "host=postgresql-covid-bd.alwaysdata.net port=5432 dbname=covid-bd_postgresql user=covid-bd password=Ucp2020=";
$dbconn = pg_pconnect($conn_string);

$sql = "SELECT EXISTS (SELECT * FROM pays WHERE nom_pays = '".$_GET['pays']."') AS existe;";
$result = pg_query($dbconn, $sql);
$row = pg_fetch_row($result);
$existe = $row[0];

if ($existe == 't') {
	$sql = "SELECT EXISTS (SELECT * FROM consulter WHERE pseudo = '".$_SESSION['pseudo']."' AND pays = '".$_GET['pays']."') AS existe;";    
	$result = pg_query($dbconn, $sql);
	$row = pg_fetch_row($result);
	$existe = $row[0];

	if ($existe != 't') {
		$sql = "INSERT INTO consulter (pseudo, pays) VALUES ('".$_SESSION['pseudo']."', '".$_GET['pays']."');";
		$result = pg_query($dbconn, $sql);
	}
}

$datey = date('y');
$datem = date('m');
$dated = date('d');
$dates = date_create("20$datey-$datem-$dated");
date_sub($dates, date_interval_create_from_date_string('7 days'));

$pays = $_GET['pays'];
$sql3= "SELECT * FROM stat_quotidiennes WHERE pays = '$pays' AND date > '".date_format($dates, 'Y-m-d')."' ORDER by date;" ;
$result3 = pg_query($dbconn, $sql3);

$max = pg_num_rows($result3);


$array1 = array();

for($i = 0; $i < $max; $i++) {
	$date = pg_fetch_result($result3, $i, 4);
	$y = pg_fetch_result($result3, $i, 1);
	$temp = array("label" => "".$date, "y" => $y);
	array_push($array1, $temp);
}

$dataPoints1 = $array1;


$array2 = array();

for($i = 0; $i < $max; $i++) {
	$date = pg_fetch_result($result3, $i, 4);
	$y = pg_fetch_result($result3, $i, 2);
	$temp = array("label" => "".$date, "y" => $y);
	array_push($array2, $temp);
}

$dataPoints2 = $array2;


$array3 = array();

for($i = 0; $i < $max; $i++) {
	$date = pg_fetch_result($result3, $i, 4);
	$y = pg_fetch_result($result3, $i, 3);
	$temp = array("label" => "".$date, "y" => $y);
	array_push($array3, $temp);
}
$dataPoints3 = $array3;

?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<title>Covid BD</title>
	<link rel="stylesheet" type="text/css" href="./bootstrap_4.5.0/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="styles/main.css">
	<script>
		window.onload = function() {

			var chart = new CanvasJS.Chart("chartContainer", {
				animationEnabled: true,
				theme: "light2",
				title: {
					text: "Statistiques des derniers jours"
				},
				axisY: {
					includeZero: true
				},
				legend: {
					cursor: "pointer",
					verticalAlign: "center",
					horizontalAlign: "right",
					itemclick: toggleDataSeries
				},
				data: [{
					type: "column",
					name: "Confirmé",
					indexLabel: "{y}",
					yValueFormatString: "#0.##",
					showInLegend: true,
					dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
				}, {
					type: "column",
					name: "Guéris",
					indexLabel: "{y}",
					yValueFormatString: "#0.##",
					showInLegend: true,
					dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
				}, {
					type: "column",
					name: "Morts",
					indexLabel: "{y}",
					yValueFormatString: "#0.##",
					showInLegend: true,
					dataPoints: <?php echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); ?>
				}]
			});
			chart.render();

			function toggleDataSeries(e) {
				if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
					e.dataSeries.visible = false;
				} else {
					e.dataSeries.visible = true;
				}
				chart.render();
			}

		}
	</script>
</head>

<body class="container vh-100 ligne">
	<div class="row">
		<?php
		if (isset($_GET['pays'])) {
			echo " <h1 class='col-sm'>Voici le pays  " . $_GET['pays'] . " </h1>";
			echo "\r\n";

			$pays = $_GET['pays'];
		} 
		else {
			echo "Erreur Formulaire.";
		}
		?>
	</div>
	<div class="row">
		<?php
		if ($dbconn) {
			$sql = "SELECT * FROM pays WHERE nom_pays='$pays';";
			$result = pg_query($dbconn, $sql);
			$sql2 = "SELECT EXISTS (SELECT nom_pays FROM pays WHERE nom_pays = '$pays') AS exist";
			$result2 = pg_query($dbconn, $sql2);
			$val = pg_fetch_result($result2, 0, 0);

			if ($val == 'f') {
				echo "Aucune donnée saisie pour ce pays ";
			} 
			else {
				$nb_hab = pg_fetch_result($result, 0, 1);
				echo "<div class=\"infoPays\">Nombre d'habitants : " . ($nb_hab) . "</div> ";

				$date_cas = pg_fetch_result($result, 0, 2);
				echo "<div class=\"infoPays\">Date du premier cas : " . ($date_cas) . "</div>";
		?>
	</div>
	<div class="row ligne">
		<?php
				$taux_mort = pg_fetch_result($result, 0, 3);
				echo "<div id=\"tauxGueris\">Taux de mortalité : " . ($taux_mort) . "%</div>";
				$taux_ret = pg_fetch_result($result, 0, 4);
				echo "<div id=\"tauxMort\">Taux de retablissement : " . ($taux_ret) . "%</div>";
			}
		?>
	</div>
	<div class="row ligne">
		<div id="chartContainer" style="height: 370px; width: 100%;"></div>
		<?php
		} else {
			echo "Connexion a la base de données impossible actuellement";
		}
		?>
	</div>

	<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>

</html>