<?php
include ("mysql.php");
	$requete = "SELECT batiment.nom, capteur.etage, capteur.salle, capteur.type, capteur.id FROM batiment LEFT JOIN capteur ON capteur.batiment = batiment.id;";
				$resultat = mysqli_query($id_bd, $requete)
					or die("Execution de la requete impossible : $requete");
	$capteur = array();
    while($ligne=mysqli_fetch_assoc($resultat))
	{	
	extract($ligne);
	$topic = "iut/$nom/etage$etage/$salle/$type";
	$requete = "UPDATE capteur SET topic = '$topic' WHERE capteur.salle = '$salle';";
		mysqli_query($id_bd, $requete)
			or die("Execution de la requete impossible : $requete");
	}
	mysqli_close($id_bd);
?>