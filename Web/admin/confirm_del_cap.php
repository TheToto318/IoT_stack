<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Capteur supprimé</title>
</head>
<body>

	<?php 

	session_start();

        if(!isset($_SESSION['name_admin']))
        {
            header('Location: ../');
        }

        $db_user = "root";
        $db_pass = "";
        $db_name = "sae23";
        $db_host = "localhost";

        $db = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

        echo("Le capteur a bien été supprimé, ainsi que les données y appartennant.");

	?>

	<br />
	<a href="del_cap.php">Supprimer un autre capteur</a><br />
    <a href="/SAE23/admin">Revenir à la page d'administration</a>
</body>
</html>