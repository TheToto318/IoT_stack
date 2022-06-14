
<?php
  //connection au serveur:
  $cnx = mysql_connect( "localhost", "root", "22104338" ) ;
 
  //sélection de la base de données:
  $db = mysql_select_db( "SAE23bis" ) ;
 
  //récupération de la variable d'URL,
  //qui va nous permettre de savoir quel batiment supprimer:
  $nom  = $_GET["nom"] ;
 
  //création de la requête SQL:
  $sql = "DELETE FROM Batiment WHERE nom = ".$nom ;

  echo $sql ;	    
  //exécution de la requête:
  $requete = mysql_query( $sql, $cnx ) or die( mysql_error() ) ;
 
  //affichage des résultats, pour savoir si la suppression a marchée:
  if($requete)
	{
		header("Location:confirm_del_bat.php") ; 
	}
	else
	{
		header("Location:del_bat.php");
		echo("Erreur : La suppression du bâtiment a échouée") ;
	}
?>
 
