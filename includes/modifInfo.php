<?php

session_start();

if(isset($_POST) && isset($_POST['pseudo']) && isset($_POST['email'])) {
	$conn_string = "host=postgresql-covid-bd.alwaysdata.net port=5432 dbname=covid-bd_postgresql user=covid-bd password=Ucp2020=";
	$dbconn = pg_pconnect($conn_string);

	$pseudo = $_POST['pseudo'];
	$email = $_POST['email'];

	if ($dbconn) {
		$dif = strcmp($email, $_SESSION['email']);
		echo $dif;
		if ($dif) {
			$sql = "UPDATE utilisateur SET email = '".$email."' WHERE pseudo = '".$_SESSION['pseudo']."';";
			$result = pg_query($dbconn, $sql);
			$_SESSION['email'] = $email;
		}
	
		$dif = strcmp($pseudo, $_SESSION['pseudo']);
		if ($dif) {
			$sql = "UPDATE utilisateur SET pseudo = '".$pseudo."' WHERE pseudo = '".$_SESSION['pseudo']."';";
			$result = pg_query($dbconn, $sql);
			$_SESSION['pseudo'] = $pseudo;
		}
	}
}

header('Location: ../accueil.php');

?>