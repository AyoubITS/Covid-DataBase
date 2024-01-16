<?php

session_start();

if(isset($_POST) && !empty($_POST['pseudo']) && !empty($_POST['mdp'])) {
	extract($_POST);

	$conn_string = "host=postgresql-covid-bd.alwaysdata.net port=5432 dbname=covid-bd_postgresql user=covid-bd password=Ucp2020=";
	$dbconn = pg_pconnect($conn_string);

	$mdpHash = hash('sha512', $mdp);

	$sql = "SELECT EXISTS (SELECT * FROM utilisateur WHERE pseudo = '".$pseudo."' AND mdp = '".$mdpHash."') AS id_correct;";

	$result = pg_query($dbconn, $sql);

	$row = pg_fetch_row($result);

	$exist = $row[0];

	if ($exist == 't') {
		$sql = "DELETE FROM consulter WHERE pseudo = '".$pseudo."';";
		$result = pg_query($dbconn, $sql);
		$sql = "DELETE FROM utilisateur WHERE pseudo = '".$pseudo."';";
		$result = pg_query($dbconn, $sql);

		header('Location: ../index.php');
	}
	else
		header('Location: ../information.php?erreur=3');
}

else
	header('Location: ../index.php?erreur=4');

?>