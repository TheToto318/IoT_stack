<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Building added</title>
</head>
<body>

	<?php 

	session_start();

        if(!isset($_SESSION['name_admin']))
        {
            header('Location: ../');
        }

        include ("mysql.php");

        echo("Building as been created");

	?>

	<br />
	<a href="add_bat.php">Add an other building</a><br />
	<a href="add_cap.php">Add a sensor</a><br />
    <a href="./">Back to admin page</a>
</body>
</html>