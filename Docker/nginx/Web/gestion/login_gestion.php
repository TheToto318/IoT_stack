<!DOCTYPE html>
<html>
<head>
	<title>Management login</title>
</head>
<body>

	<?php

		echo("Please login to acces your building metrics");

		session_start();

		if(isset($_SESSION['name_gestion']))
		{
			if(substr($_SESSION['name_gestion'], 0, 7) == 'Gestio-')
			{
				header("Location: ./");
			}
		}

        if(isset($_GET['erreur']))
        {
            $err = $_GET['erreur'];
            if($err == 1)
            {
                echo("<div class='erreur'>Login or password incorrect</div>");
            }
        }

	?>

	<form action="verif_gestion.php" method="POST">
		<input type="text" name="login" placeholder="login">	
		<input type="password" name="password" placeholder="password">
		<input type ="submit" name="submit" value="Connexion">
		<br />
		<br />
		<a href="../index.php">Home</a>
	</form>

</body>
</html>