<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>

	<?php

		echo("Login...<br /><br />");

		include ("../mysql.php");

		$login = mysqli_real_escape_string($db,htmlspecialchars($_POST['login']));
    	$password = mysqli_real_escape_string($db,htmlspecialchars($_POST['password']));

		$id = "SELECT login, mdp FROM Batiment WHERE login='$login'";
		$qry = mysqli_query($db, $id);

		if (mysqli_num_rows($qry) > 0)
		{
		  	$row = mysqli_fetch_assoc($qry);
		    	$user = $row["login"];
		    	$hash = $row["mdp"];
		}
		else
		{
			header('Location: ./login_gestion.php?erreur=1');
		}

		if(password_verify($password, $hash) == 1 && $login == $user)
		{
			session_start();
			
			if(isset($_SESSION['name_admin']))
			{
				unset($_SESSION['name_admin']);
			}

			$_SESSION['name_gestion'] = $user;
			header('Location: ./');
		}
		else
		{
			header('Location: ./login_gestion.php?erreur=1');
		}

	?>

</body>
</html>