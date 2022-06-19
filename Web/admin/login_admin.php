<!DOCTYPE html>
<html>
<html lang="en">
<head>
	<title>Admin login</title>
	<link rel="stylesheet" href="../style/styleLogin.css">
</head>
<body>

	<div class="bandeau">Admin login</div>
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



		if(isset($_SESSION['name_admin']))
		{
			if($_SESSION['name_admin'] == "Admin")
			{
				header("Location: ./");
				exit;
			}
		}

        if(isset($_GET['erreur']))
        {
            $err = $_GET['erreur'];
            if($err == 1)
            {
                echo("<div class='erreur'>Wrong login or password</div>");
            }
        }

	?>

	<div class="connexion">
		<form action="verif_admin.php" method="POST">
			<div class="login"><input type="text" name="login" placeholder="Login"></div>
			<div class="password"><input type="password" name="password" placeholder="Password"></div>
			<div class="submit"><input type="submit" name="submit" value="Log in"></div>
		</form>
	</div>

</body>
</html>















