<!DOCTYPE html>
<html>
<head>
	<title>Deconnexion</title>
</head>
<body>

	<?php

		session_start();
		unset($_SESSION['name_gestion']);
		session_destroy();
		header('Location: /SAE23/');

	?>

</body>
</html>