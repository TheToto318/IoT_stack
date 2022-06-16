<!DOCTYPE html>
<html>
<head>
	<title>Connexion Administration</title>
</head>
<body>

	<?php

		echo("Bonjour !<br />Connexion à la page d'administration.<br /><br />");

		session_start();

		if(isset($_SESSION['name_admin']))
		{
			if($_SESSION['name_admin'] == 'Admin')
			{
				header('Location: /SAE23/admin/');
			}
		}

        if(isset($_GET['erreur']))
        {
            $err = $_GET['erreur'];
            if($err == 1)
            {
                echo("<div class='erreur'>Identifiants incorrects</div>");
            }
        }

	?>

	<form action="verif_admin.php" method="POST">
		<input type="text" name="login" placeholder="login">	
		<input type="password" name="password" placeholder="password">
		<input type ="submit" name="submit" value="Connexion">
		<br />
		<br />
		<a href="../index.php">Retour à l'accueil</a>
	</form>

</body>
</html>