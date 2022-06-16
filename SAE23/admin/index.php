<!DOCTYPE html>
<html>
<head>
	<title>Administration</title>
</head>
<body>

	<?php

		session_start();

		if(isset($_SESSION['name_gestion']))
		{
			unset($_SESSION['name_gestion']);
		}

		if(!isset($_SESSION['name_admin']))
		{
			header('Location: /SAE23/');
		}

		echo("Page d'administration<br /><br />");

		$db_user = "root";
		$db_pass = "";
		$db_name = "sae23";
		$db_host = "localhost";

		$db = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

	?>

	<a href="add_bat.php">Ajouter un batiment</a>
	<br />
	<a href="del_bat.php">Supprimer un batiment</a>
	<br />
	<a href="add_cap.php">Ajouter un capteur</a>
	<br />
	<a href="del_cap.php">Supprimer un capteur</a>
	<br />
	<br />
	<a href="deconnexion_admin.php">Deconnexion</a>
	<br />
	<a href="../">Retour à l'accueil</a>

</body>
</html>