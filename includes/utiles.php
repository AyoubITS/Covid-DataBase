<?php

function messageErreur() {
	if(isset($_GET['erreur'])) {
		$erreur = $_GET['erreur'];

		$message = '';

		switch ($erreur) {
			case 1:
				$message = '<label style="display: inline;width: 450px;color: red;">Connexion à la base de donnée échoué.</label>';
				break;
			case 2:
				$message = '<label style="display: inline;width: 300px;color: red;">Veuillez remplir votre identifiant et votre mot de passe.</label>';
				break;
			case 3:
				$message = '<label style="display: inline;width: 300px;color: red;">Identifiant ou mot de passe incorrecte.</label>';
				break;
			case 4:
				$message = '<label style="display: inline;width: 300px;color: red;">Tous les champs n\'ont pas été remplis.</label>';
				break;
			case 5:
				$message = '<label style="display: inline;width: 300px;color: red;">Une erreur est survenue lors de la suppression.</label>';
				break;
			default:
				break;
		}
		echo $message;
	}
}


function getPays($dbconn) {
	if(isset($_SESSION['pseudo'])) {
		$sql = "SELECT pays FROM consulter WHERE pseudo = '".$_SESSION['pseudo']."' LIMIT 5;";
		$result = pg_query($dbconn, $sql);

		echo "<ul>";
		while ($row = pg_fetch_row($result)) {
			echo "<li><a href = \"./stats.php?pays=".$row[0]."\">".$row[0]."</a></li>";
		}
		echo "</ul>";
	}
}

?>