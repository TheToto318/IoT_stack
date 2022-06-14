<?php
  //connection au serveur
  $cnx = mysql_connect( "localhost", "root", "22104338" ) ;
 
  //sélection de la base de données:
  $db  = mysql_select_db( "SAE23bis" ) ;
 
  //récupération des valeurs des champs:
  //nom:
  $nom = $_POST["nom"] ;
  //login:
  $login = $_POST["login"] ;
  //mot de passe:
  $mdp = $_POST["mdp"] ;
  
  //création de la requête SQL:
  $sql = "INSERT  INTO Batiment (nom, login, mdp)
            VALUES ( '$nom', '$login', '$mdp') " ;
 
  //exécution de la requête SQL:
  $requete = mysql_query($sql, $cnx) or die( mysql_error() ) ;
 
  //affichage des résultats, pour savoir si l'insertion a marchée:
  if($requete)
  {
    header("Location:confirm_bat.php") ; 
  }
  else
  {
    header("Location:add_bat.php");
	echo("Erreur : l'ajout du bâtiment a échoué") ;
  }
?>
