<?php

$conn_string = "host=postgresql-covid-bd.alwaysdata.net port=5432 dbname=covid-bd_postgresql user=covid-bd password=Ucp2020=";
$dbconn = pg_pconnect($conn_string);

if ($dbconn) {	
	if(isset($_POST) && !empty($_POST['pseudo']) && !empty($_POST['mdp'])) {
		extract($_POST);

		$mdpHash = hash('sha512', $_POST['mdp']);
	
		$sql = "SELECT EXISTS (SELECT * FROM utilisateur WHERE pseudo = '".$pseudo."' AND mdp = '".$mdpHash."') AS id_correct;";
	
		$result = pg_query($dbconn, $sql);

		$row = pg_fetch_row($result);

		$exist = $row[0];

		if ($exist == 't') {
			$sql = "SELECT email FROM utilisateur WHERE pseudo = '".$pseudo."';";
			$result = pg_query($dbconn, $sql);
	
			$row = pg_fetch_row($result);
	
			$email = $row[0];
	
			session_start();
			$_SESSION['pseudo'] = $pseudo;
			$_SESSION['email'] = $email;
			header('Location: ../accueil.php');
		}
		else {
			header('Location: ../index.php?erreur=3');
		}
	}
	else {
		header('Location: ../index.php?erreur=2');
	}
}

else {
	header('Location: ../index.php?erreur=1');
}
?>