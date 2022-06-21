<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
</head>
<body>

	<?php

		echo("Login...<br /><br />");

		include ("../mysql.php");

		$login = mysqli_real_escape_string($db,htmlspecialchars($_POST['login']));			//getting values from the login page
    	$password = mysqli_real_escape_string($db,htmlspecialchars($_POST['password']));

		$id = "SELECT login, mdp FROM batiment WHERE login='$login'";						//selecting data to compare with the submited values
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
			exit;
		}

		if(password_verify($password, $hash) == 1 && $login == $user)					//comparing data from the database and submited values
		{
			session_start();
			
			if(isset($_SESSION['name_admin']))											//disconnecting the admin if (s)he's connected
			{
				unset($_SESSION['name_admin']);
			}

			$_SESSION['name_gestion'] = $user;
			header('Location: ./select_gestion.php');									//creating the manager's session
			exit;
		}
		else
		{
			header('Location: ./login_gestion.php?erreur=1');
			exit;
		}

	?>

</body>
</html>