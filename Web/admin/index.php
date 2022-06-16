<!DOCTYPE html>
<html>
<head>
	<title>Admin page</title>
</head>
<body>

	<?php

		session_start();

		if(isset($_SESSION['name_gestion']))
		{
			unset($_SESSION['name_gestion']);
		}

		if(!isset($_SESSION['name_admin']))
		{
			header('Location: ../');
		}

		echo("Admin page<br /><br />");

		include ("mysql.php");

	?>

	<a href="add_bat.php">Add a building</a>
	<br />
	<a href="del_bat.php">Delete a building</a>
	<br />
	<a href="add_cap.php">Add a sensor</a>
	<br />
	<a href="del_cap.php">Delete a sensor</a>
	<br />
	<br />
	<a href="deconnexion_admin.php">Logoff</a>
	<br />
	<a href="../">Home</a>

</body>
</html>