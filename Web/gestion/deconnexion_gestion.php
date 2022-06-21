<!DOCTYPE html>
<html lang="en">
<head>
	<title>Logoff</title>
</head>
<body>

	<?php

		session_start();
		unset($_SESSION['name_gestion']);		//deleting the manager's session so that (s)he's not connected anymore
		session_destroy();
		header('Location: ../');

	?>

</body>
</html>