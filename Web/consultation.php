<!DOCTYPE html>
<html lang="en">
<head>
    <title>Overview</title>
    <link rel="stylesheet" href="style/styleConsul.css">
</head>
<body>

    <div class="bandeau">Overview</div>

    <nav>
        <ul>
            <li><a href="./">Home</a></li>
            <li><a href="admin/login_admin.php">Admin</a></li>
            <li><a href="gestion/login_gestion.php">Management</a></li>
            <li><a href="consultation.php">Overview</a></li>
            <li><a href="mentions_legales.php">Terms of service</a></li>
        </ul>
    </nav>
  
    <div class="info">Last value of each room :</div>

	<?php
		    include ("mysql.php");

        $reqBat = "SELECT id, nom FROM batiment";
        $resBat = mysqli_query($db, $reqBat);

        echo("<table>");
        echo("<tr><th>Building</th><th>Floor</th><th>Room</th><th>Sensor</th><th>Date</th><th>Hour</th><th>Value</th></tr>");

        for($i = 0; $i < mysqli_num_rows($resBat); $i++){

        	$bat = mysqli_fetch_assoc($resBat);
        	$idBat = $bat["id"];
        	$nomBat = $bat["nom"];

        	$reqSalle = "SELECT DISTINCT salle FROM capteur WHERE batiment = '$idBat'";
        	$resSalle = mysqli_query($db, $reqSalle);

        	for($j = 0; $j < mysqli_num_rows($resSalle); $j++){

        		$sal = mysqli_fetch_assoc($resSalle);
	        	$salle = $sal["salle"];
	        	
	        	$reqVal = "SELECT valeur.*, mesure.*, capteur.etage, capteur.type FROM valeur LEFT JOIN mesure ON valeur.id_mesure = mesure.id LEFT JOIN capteur ON valeur.id_capteur = capteur.id LEFT JOIN batiment ON capteur.batiment = batiment.id WHERE capteur.salle = '$salle' AND batiment.id = '$idBat' ORDER BY mesure.date DESC, mesure.heure DESC LIMIT 1";
	        	$resVal = mysqli_query($db, $reqVal);

	        	echo("<tr>");

	        	for($k = 0; $k < mysqli_num_rows($resVal); $k++){

					$mes = mysqli_fetch_assoc($resVal);
					$date = $mes["date"];
		        	$heure = $mes["heure"];
		        	$valeur = $mes["valeur"];
		        	$type = $mes["type"];
		        	$etage = $mes["etage"];

		        	echo("<td>" . $nomBat . "</td><td>" . $etage  . "</td><td>" . $salle  . "</td><td>" . $type  . "</td><td>" . $date  . "</td><td>" . $heure  . "</td><td>" . $valeur  . "</td>");
	        	}
        	}
        }

        echo("</table>");

    ?>

<footer>
    <a href="https://jigsaw.w3.org/css-validator/check/referer">
        <img src="https://jigsaw.w3.org/css-validator/images/vcss"
            alt="CSS Valide !" />
    </a>
    <a href="https://html5.validator.nu/?doc=https://sae23.cloudroux.ovh/consultation.php">
         <img src="media/html5-validator-badge-blue.svg" alt="HTML5 Valid" />
    </a>
</footer>
</body>
</html>