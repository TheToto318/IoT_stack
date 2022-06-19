<!DOCTYPE html>
<html lang="en">
<head>
	<title>Logoff</title>
</head>
<body>

	<?php

		session_start();
		unset($_SESSION['name_gestion']);
		session_destroy();
		header('Location: ../');

	?>

</body>
</html>