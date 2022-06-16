<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>

	<?php

		echo("Login in<br /><br />");

		include ("mysql.php");

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
			header('Location: ./login_admin.php');
		}

		if(password_verify($password, $hash) == 1 && $login == $user)
		{
			session_start();

			if(isset($_SESSION['name_gestion']))
			{
				unset($_SESSION['name_gestion']);
			}

			$_SESSION['name_admin'] = $user;
			header('Location: ./');
		}
		else
		{
			header('Location: ./login_admin.php?erreur=1');
		}

	?>

</body>
</html>