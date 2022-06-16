<!DOCTYPE html>
<html>
<head>
    <title>Consultation</title>
    <link rel="stylesheet" href="style/styleConsul.css">
</head>
<body>

	<?php

		$db_user = "root";
        $db_pass = "";
        $db_name = "sae23";
        $db_host = "localhost";

        $db = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

        echo("Consultation<br /><br />");

        $reqBat = "SELECT id, nom FROM batiment";
        $resBat = mysqli_query($db, $reqBat);

        echo("<table>");
        echo("<tr><th>Bâtiment</th><th>Etage</th><th>Salle</th><th>Capteur</th><th>Date</th><th>Heure</th><th>Valeur</th></tr>");

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

	<br />
    <a href="./">Home</a>

</body>
</html>