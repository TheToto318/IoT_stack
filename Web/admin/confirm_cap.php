<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Sensor added</title>
	<link rel="stylesheet" href="../style/styleAdmin.css">
</head>
<body>

	<div class="bandeau">Add sensor</div>
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

        if(!isset($_SESSION['name_admin']))
        {
            header('Location: ../');
        }

        include ("../mysql.php");

        echo("<div class='confirm'>Sensor has been created</div>");

	?>

	<div class="form2">
		<div class="ele1"><a href="add_cap.php">Add an other sensor</a></div>
		<div class="ele2"><a href="del_cap.php">Delete a sensor</a></div>
	    <div class="ele3"><a href="./">Back to admin page</a></div>
	</div>

</body>
</html>