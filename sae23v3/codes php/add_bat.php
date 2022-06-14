<!DOCTYPE html>
<html>
  <head>
    <title>Ajout d'un bâtiment</title>
	<meta charset="UTF-8">
  </head>
<body>
<h1>Ajout d'un batiment</h1>
<form name="insertion" action="envoie_add_bat.php" method="POST">
  <table border="0" align="left" cellspacing="2" cellpadding="2">
    <tr align="left">
      <td>Nom</td>
      <td><input type="text" name="nom"></td>
    </tr>
    <tr align="left">
      <td>Login</td>
      <td><input type="text" name="login"></td>
    </tr>
    <tr align="left">
      <td>Mot de passe</td>
      <td><input type="text" name="mdp"></td>
    </tr>
  
    <tr align="left">
      <td colspan="2"><input type="submit" value="Ajouter le bâtiment"></td>
    </tr>
  </table>
</form>
</body>
</html>
