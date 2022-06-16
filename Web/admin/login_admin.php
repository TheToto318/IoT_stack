<!DOCTYPE html>
<html>
<head>
	<title>Admin login</title>
</head>
<body>

	<?php

		echo("Please use your credentials to login to the admin page");

		session_start();

		if(isset($_SESSION['name_admin']))
		{
			if($_SESSION['name_admin'] == 'Admin')
			{
				header('Location: ./admin/');
			}
		}

        if(isset($_GET['erreur']))
        {
            $err = $_GET['erreur'];
            if($err == 1)
            {
                echo("<div class='erreur'>Incorrect user or password</div>");
            }
        }

	?>

	<form action="verif_admin.php" method="POST">
		<input type="text" name="login" placeholder="login">	
		<input type="password" name="password" placeholder="password">
		<input type ="submit" name="submit" value="Login">
		<br />
		<br />
		<a href="../index.php">Home</a>
	</form>

</body>
</html>