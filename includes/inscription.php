<?php

$conn_string = "host=postgresql-covid-bd.alwaysdata.net port=5432 dbname=covid-bd_postgresql user=covid-bd password=Ucp2020=";
$dbconn = pg_pconnect($conn_string);

if ($dbconn) {	
	if(isset($_POST) && !empty($_POST['pseudo']) && !empty($_POST['mdp']) && !empty($_POST['email'])) {
		extract($_POST);

		$pseudo = $_POST['pseudo'];
		$mdp = $_POST['mdp'];
		$email = $_POST['email'];

		$mdpHash = hash('sha512', $_POST['mdp']);
	
		$sql = "INSERT INTO utilisateur (pseudo, mdp, email) VALUES ('".$pseudo."', '".$mdpHash."', '".$email."');";
	
		pg_query($dbconn, $sql);
	
		session_start();
		$_SESSION['pseudo'] = $pseudo;
		$_SESSION['email'] = $email;
		header('Location: ../accueil.php?pseudo='.$pseudo);
	}
	else {
		header('Location: ../index.php?erreur=4');
	}
}

else {
	header('Location: ../index.php?erreur=1');
}
?>