<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Suppression d'un capteur </title>
		<meta charset="UTF-8"/>
	</head>
	<body>
	<h1>Suppression d'un capteur</h1>
	<form name= "Ajout_cap" action="envoie_del_cap.php" method="post" enctype="text/plain">
	<fieldset>
		<legend>Informations</legend> <!-- Fieldset title -->
	
	<table border="0" align="left" cellspacing="3" cellpadding="3">
    <tr align="center">
      <td>Salle :</td>
      <td><input type="text" name="salle" placeholder="E208" size="30" maxlength="20"></td>
    </tr>
      <p> Capteur de type:
      <input type="radio" name="Type" value="co2" id="co2" /><label for="co2"> CO2</label>
      <input type="radio" name="Type" value="lum" id="lum" /><label for="co2"> Luminosité</label>
      <input type="radio" name="Type" value="temp" id="temp" /><label for="co2"> Température</label>
    <tr align="center">
      <td>Topic :</td>
      <td><input type="text" name="Topic" placeholder=" ex: iut/RT/etage0/E001/temperature" size="40" maxlength="40"></td>
    </tr>
     <tr align="center">
      <td colspan="2"><input type="submit" value="Supprimer le capteur"></td>
    </tr>
  </fieldset>
  </form>
	</body>
</html>
