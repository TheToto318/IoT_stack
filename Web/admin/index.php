<!DOCTYPE html>
<html lang="en">
<head>
	<title>Admin page</title>
	<link rel="stylesheet" href="../style/styleAdmin.css">
</head>
<body>

	<div class="bandeau">Administration</div>
	<nav>
        <ul>
            <li><a href="../">Home</a></li>
            <li><a href="login_admin.php">Admin</a></li>
            <li><a href="../gestion/login_gestion.php">Management</a></li>
            <li><a href="../consultation.php">Overview</a></li>
            <li><a href="../mentions_legales.php">Terms of service</a></li>
        </ul>
    </nav>

	<?php

		session_start();

		if(isset($_SESSION['name_gestion']))
		{
			unset($_SESSION['name_gestion']);			//if a manager is connected, his session is deleted so that a manager and a administrator cannot be connected at the same time.
		}

		if(!isset($_SESSION['name_admin']))
		{
			header('Location: login_admin.php');	//if someone tries to access this page without being logged as an Admin, (s)he's redirected to the login page
		}

		include ("../mysql.php");

	?>

	<div class="select">
		<div class="addBat"><a href="add_bat.php">Add a building</a></div>			<!-- showing the different options for the admin -->
		<br />
		<div class="delBat"><a href="del_bat.php">Delete a building</a></div>
		<br />
		<div class="addCap"><a href="add_cap.php">Add a sensor</a></div>
		<br />
		<div class="delCap"><a href="del_cap.php">Delete a sensor</a></div>
		<br />
		<div class="logoff"><a href="deconnexion_admin.php">Logoff</a></div>
	</div>
</body>
</html>

















