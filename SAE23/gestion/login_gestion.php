<!DOCTYPE html>
<html>
<head>
	<title>Connexion Administration</title>
</head>
<body>

	<?php

		echo("Bonjour !<br />Connexion à la page de Gestion.<br /><br />");

		session_start();

		if(isset($_SESSION['name_gestion']))
		{
			if(substr($_SESSION['name_gestion'], 0, 7) == 'Gestio-')
			{
				header('/');
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

	<form action="verif_gestion.php" method="POST">
		<input type="text" name="login" placeholder="login">	
		<input type="password" name="password" placeholder="password">
		<input type ="submit" name="submit" value="Connexion">
		<br />
		<br />
		<a href="../index.php">Retour à l'accueil</a>
	</form>

</body>
</html>