<?php
date_default_timezone_set("Europe/Paris");
include ("mysql.php");
	$requete = "SELECT capteur.id, capteur.topic FROM capteur;";
				$resultat = mysqli_query($id_bd, $requete)
					or die("Execution de la requete impossible : $requete");
	$capteur = array();
    while($ligne=mysqli_fetch_assoc($resultat))
	{	
	extract($ligne);
	$capteur[] = array('topic' => $topic, 'capteur_id' => $id);
	}

	$capteur_size = count($capteur);

	for ($i = 0; $i <= $capteur_size - 1; $i++)
	{
		$topic = $capteur[$i]["topic"];
		
		$capteur_id = $capteur[$i]["capteur_id"];
		$value = shell_exec("mosquitto_sub -h mqtt -t $topic -C 1 -F %p");
		$date = date("Y-m-d");
		$time = date("H:i:s");
		$requete = "INSERT INTO mesure (date, heure) VALUES ('$date', '$time');";
		mysqli_query($id_bd, $requete)
			or die("Execution de la requete impossible : $requete");
		$requete = "SELECT mesure.id FROM mesure ORDER BY id DESC LIMIT 1;";
		$resultat = mysqli_query($id_bd, $requete)
			or die("Execution de la requete impossible : $requete");
		$ligne=mysqli_fetch_assoc($resultat);
		extract($ligne);
		$requete = "INSERT INTO valeur (valeur, id_capteur, id_mesure) VALUES ('$value', '$capteur_id', '$id');";
		mysqli_query($id_bd, $requete)
			or die("Execution de la requete impossible : $requete");
		printf("%s %s %s\n", $topic, $date, $time);	
	}
	mysqli_close($id_bd);
?>