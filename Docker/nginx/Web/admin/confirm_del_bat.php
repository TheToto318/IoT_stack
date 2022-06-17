<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Building deleted</title>
</head>
<body>

	<?php 

	session_start();

        if(!isset($_SESSION['name_admin']))
        {
            header('Location: ../');
        }

        include ("../mysql.php");

        echo("Building and associated sensors deleted.");

	?>

	<br />
	<a href="del_bat.php">Delete an other building</a><br />
	<a href="del_cap.php">Delete a sensor</a><br />
    <a href="./">Back to admin page</a>
</body>
</html>