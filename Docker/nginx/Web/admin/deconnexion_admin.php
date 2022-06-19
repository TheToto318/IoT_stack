<!DOCTYPE html>
<html>
<head>
	<title>Logoff</title>
</head>
<body>

	<?php

		session_start();
		unset($_SESSION['name_admin']);
		session_destroy();
		header('Location: ../');

	?>

</body>
</html>