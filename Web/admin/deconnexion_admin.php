<!DOCTYPE html>
<html lang="en">
<head>
	<title>Logoff</title>
</head>
<body>

	<?php

		session_start();
		unset($_SESSION['name_admin']); 			//deleting from $_SESSION the admin username
		session_destroy();							//destroying the session
		header('Location: ../');

	?>

</body>
</html>