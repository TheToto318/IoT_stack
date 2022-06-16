<?php
	$cnx = mysql_connect("localhost", "root", ""); //Connection to the sql server

	$db = mysql_select_db("INFOS"); //Choice of the imported db

// Variables choice

	$salle = $_POST['salle'];

	$type = $_POST['type'];

	$topic = $_POST['topic'];

//SQL request

	$sql ="DELETE FROM Capteur (salle, type, topic)
						VALUES ('$salle', '$type', '$topic')";

$requete=mysql_query($sql, $cnx) or die( mysql_error() );

	//Confirm or deny deletion.
if($requete)
  {
    header("Location:confirm_del_cap.php") ; 
  }
  else
  {
    header("Location:del_cap.php");
		echo("Erreur, veuillez réessayer.") ;
  }
?>