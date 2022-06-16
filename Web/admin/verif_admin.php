<!DOCTYPE html>
<html>
<head>
	<title>Connexion</title>
</head>
<body>

	<?php

		echo("Connexion en cours...<br /><br />");

		$db_user = "root";
		$db_pass = "";
		$db_name = "sae23";
		$db_host = "localhost";

		$db = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

		$id = "SELECT login, mdp FROM Administration";
		$qry = mysqli_query($db, $id);

		$login = mysqli_real_escape_string($db,htmlspecialchars($_POST['login']));
    	$password = mysqli_real_escape_string($db,htmlspecialchars($_POST['password']));

		if (mysqli_num_rows($qry) > 0)
		{
		  	$row = mysqli_fetch_assoc($qry);
		    	$user = $row["login"];
		    	$hash = $row["mdp"];
		} 
		else
		{
			header('Location: http://localhost/SAE23/admin/login_admin.php');
		}

		if(password_verify($password, $hash) == 1 && $login == $user)
		{
			session_start();

			if(isset($_SESSION['name_gestion']))
			{
				unset($_SESSION['name_gestion']);
			}

			$_SESSION['name_admin'] = $user;
			header('Location: http://localhost/SAE23/admin/');
		}
		else
		{
			header('Location: http://localhost/SAE23/admin/login_admin.php?erreur=1');
		}

	?>

</body>
</html>