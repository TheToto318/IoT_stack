<?php
	$cnx = mysql_connect("localhost", "root", ""); //Connection to the sql server

	$db = mysql_select_db("sae23bis"); //Choice of the imported db

	//Variables creation

	$salle = $_POST['salle'];

	$type = $_POST['type'];

	$topic = $_POST['topic'];

//SQL request

	$sql ="INSERT INTO Capteur (salle, type, topic)
						VALUES ('$salle', '$type', '$topic')";

$requete=mysql_query($sql, $cnx) or die( mysql_error() );

//Confirm or deny the addition of the sensor.

if($requete)
  {
    header("Location:confirm_cap.php") ; 
  }
  else
  {
    header("Location:add_cap.php");
	echo("Veuillez réessayer") ;
  }
?>