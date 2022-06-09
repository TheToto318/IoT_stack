<?php
/* Script de connexion à la base sae 23 */

  $id_bd = mysqli_connect("db","sae23","sae23pass","sae23")
    or die("Connexion au serveur et/ou à la base de données impossible");

  /* Gestion de l'encodage des caractères */
  mysqli_query($id_bd, "SET NAMES 'utf8'");

?>
