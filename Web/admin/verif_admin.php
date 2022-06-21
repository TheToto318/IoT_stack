<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
</head>
<body>

	<?php

		echo("Login in<br /><br />");

		include ("../mysql.php");

		$id = "SELECT login, mdp FROM administration";				//selectisng the admin's credentials to compare with the submited value
		$qry = mysqli_query($db, $id);

		$login = mysqli_real_escape_string($db,htmlspecialchars($_POST['login']));				//collecting the submited values
    	$password = mysqli_real_escape_string($db,htmlspecialchars($_POST['password']));

		if (mysqli_num_rows($qry) > 0)			//checking if the administrator exists
		{
		  	$row = mysqli_fetch_assoc($qry);
		    	$user = $row["login"];
		    	$hash = $row["mdp"];
		} 
		else
		{
			header('Location: ./login_admin.php');
		}

		if(password_verify($password, $hash) == 1 && $login == $user)		//comparing the administrators real credentials and the submited values
		{
			session_start();

			if(isset($_SESSION['name_gestion']))
			{
				unset($_SESSION['name_gestion']);				//if a manager is connected, (s)he's removed from $_SESSION so that (s)he's not connected anymore
			}

			$_SESSION['name_admin'] = $user;				//the admin session is set
			header('Location: ./');
		}
		else
		{
			header('Location: ./login_admin.php?erreur=1');			//managing errors
		}

	?>

</body>
</html>