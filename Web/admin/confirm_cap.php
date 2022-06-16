<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Sensor added</title>
</head>
<body>

	<?php 

	session_start();

        if(!isset($_SESSION['name_admin']))
        {
            header('Location: ../');
        }

        include ("mysql.php");

        echo("Sensor has been created");

	?>

	<br />
	<a href="add_cap.php">Add an other sensor</a><br />
	<a href="del_cap.php">Delete a sensor</a><br />
    <a href="./">Back to admin page</a>
</body>
</html>