<!DOCTYPE html>
<html>
<head>
	<title>Management login</title>
	<link rel="stylesheet" href="../style/styleLogin.css">
</head>
<body>

	<div class="bandeau">Management login</div>
	<nav>
        <ul>
            <li><a href="../">Home</a></li>
            <li><a href="../admin/login_admin.php">Admin</a></li>
            <li><a href="login_gestion.php">Management</a></li>
            <li><a href="../consultation.php">Overview</a></li>
            <li><a href="../mentions_legales.php">Terms of service</a></li>
        </ul>
    </nav>

	<?php
		session_start();

		if(isset($_SESSION['name_gestion']))
		{
			if(substr($_SESSION['name_gestion'], 0, 7) == 'Gestio-')
			{
				header("Location: ./");
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
		<form action="verif_gestion.php" method="POST">
			<div class="login"><input type="text" name="login" placeholder="Login"></div>
			<div class="password"><input type="password" name="password" placeholder="Password"></div>
			<div class="submit"><input type="submit" name="submit" value="Log in"></div>
		</form>
	</div>

</body>
</html>














