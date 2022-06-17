<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Sensor deleted</title>
</head>
<body>

	<?php 

	session_start();

        if(!isset($_SESSION['name_admin']))
        {
            header('Location: ../');
        }

        include ("../mysql.php");

        echo("Sensor and associated values deleted");

	?>

	<br />
	<a href="del_cap.php">Delete an other sensor</a><br />
    <a href="./">Back to admin page</a>
</body>
</html>