<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Management</title>
	<link rel="stylesheet" href="../style/styleGestion.css">
</head>
<body>
	<script src="chart/chart.js"></script>
	<script>
		var idGraph;
		var ctx;
		var myChart;
		var x;
		var y;
	</script>

	<?php

		session_start();
	
		if(isset($_SESSION['name_admin']))
		{
			unset($_SESSION['name_admin']);
		}
		if(!isset($_SESSION['name_gestion']))
		{
			header('Location: ../');
		}

		echo('<div class="session">' . $_SESSION['name_gestion'] . '</div>');

		include ("mysql.php");

//--------------------------------------------------------------------------------------------------------------------//

		$user = $_SESSION['name_gestion'];

		$bat = "SELECT id, nom FROM Batiment WHERE login = '$user'";
		$result = mysqli_query($db, $bat);
		$numBat = mysqli_fetch_assoc($result);
		$bat = $numBat["id"];
		$nomBat = $numBat["nom"];

		$etage = "SELECT DISTINCT etage FROM capteur LEFT JOIN Batiment ON Capteur.batiment = Batiment.id WHERE Batiment.id = '$bat' ORDER BY etage";
		$result_etage = mysqli_query($db, $etage);

		echo('<div class="nomBat">' . "Building $nomBat" . '</div>');

		?>

		<nav>
			<ul>
				<li><a href="../">Home</a></li>
				<li><a href="deconnexion_gestion.php">Logoff</a></li>
			</ul>
		</nav>

		<?php

		//-------------------------------------------------//

		function axesGraph($tableau)
		{
			echo("[");
	    	for($p = 0; $p<count($tableau); $p++)
	    	{
	    		echo($tableau[$p]);
	    		if($p < count($tableau)-1)
	    		{
	    			echo(", ");
	    		}					    		
	    	}
	    	echo("]");
	    }

		if(mysqli_num_rows($result_etage) > 0)
		{
			for($a = 0; $a < mysqli_num_rows($result_etage); $a++)
			{
				$numEtage = mysqli_fetch_assoc($result_etage);
				$eta = $numEtage["etage"];

				echo('<div class="etage">' . "Floor $eta" . '</div>');
				$salle = "SELECT DISTINCT salle FROM Capteur WHERE Capteur.etage = '$eta' AND Capteur.batiment = '$bat'"; 
				$result_salle = mysqli_query($db, $salle);

				for($b = 0; $b < mysqli_num_rows($result_salle); $b++)
				{
					$numSalle = mysqli_fetch_assoc($result_salle);
					$sal = $numSalle["salle"];

					echo('<div class="salle">' . "$sal" . '</div>');
					$capteur = "SELECT Capteur.id, Capteur.type FROM Capteur WHERE Capteur.salle = '$sal' AND Capteur.etage = '$eta' AND Capteur.batiment = '$bat'";
					$result_capteur = mysqli_query($db, $capteur);

					for($c = 0; $c < mysqli_num_rows($result_capteur); $c++)
					{
						$typeCapteur = mysqli_fetch_assoc($result_capteur);
						$cap = $typeCapteur["type"];
						$capId = $typeCapteur["id"];

						echo('<div class="capteur">' . "$cap" . '</div>');
						$mesure = "SELECT date, heure, valeur FROM Mesure LEFT JOIN Valeur ON Valeur.id_mesure = Mesure.id LEFT JOIN Capteur ON Valeur.id_capteur = Capteur.id WHERE Capteur.id = '$capId' AND Capteur.salle = '$sal' AND Capteur.etage = '$eta' AND Capteur.batiment = '$bat'";
						$result_mesure = mysqli_query($db, $mesure);

						if(mysqli_num_rows($result_mesure) > 0)
						{

							$dataPoints = array();
							$dataHours = array();
							$somme = 0;
							$moyenne = 0;
							$nbVal = mysqli_num_rows($result_mesure);
							$min = 0;
							$max = 0;
							$countVal = 20;
							$countDate = 20;

							echo('<div class="box"><div class="tab"><table>');

							echo("<tr><th>Date</th><th>Time</th><th>valeur</th></tr>");

							for ($d = 0; $d < mysqli_num_rows($result_mesure); $d++)
							{
								$valMesure = mysqli_fetch_assoc($result_mesure);
								$mesDate = $valMesure["date"];
								$mesHeure = $valMesure["heure"];
								$mesVal = $valMesure["valeur"];

								if($min == 0){$min = $mesVal;}

								if($cap == "temperature"){
									echo("<tr><td>$mesDate</td><td>$mesHeure</td><td>$mesVal °C</td></tr>");	
								}
								if($cap == "co2"){
									echo("<tr><td>$mesDate</td><td>$mesHeure</td><td>$mesVal ppm</td></tr>");	
								}

								
								$valHeure = explode(":", $mesHeure);
								list($heure, $minute, $seconde) = $valHeure;

								if($countVal == 20){
									array_push($dataPoints, $mesVal);
									$countVal = 0;
								}

								$countVal += 1;

								if($countDate == 20){
									array_push($dataHours, "'$heure:$minute'");
									$countDate = 0;
								}

								$countDate += 1;

								$somme = $somme + $mesVal;

								if($mesVal > $max){
									$max = $mesVal;
								}

								if($mesVal < $min){
									$min = $mesVal;
								}

							}

							echo("</table></div>");

							$moyenne = $somme / $nbVal;

							if($cap == "temperature"){
								$unite = " °C";
							}

							if($cap == "co2"){
								$unite = " ppm";
							}

							echo("<div class='mesures'><b>Mesures : </b><br />");
							echo("<br />Average : " . round($moyenne, 2) . $unite);
							echo("<br />Maximum : " . $max . $unite);
							echo("<br />Minimum : " . $min . $unite . "</div>");
							
							$idChart = "$eta-$sal-$capId";
							echo("<div class ='graph'><canvas id=$idChart ></canvas></div></div>");

							?>

							<script>

								idGraph = "<?php echo $idChart ?>";
								ctx = document.getElementById(idGraph);
								x = <?php axesGraph($dataPoints); ?>;
								y = <?php axesGraph($dataHours); ?>;

								myChart = new Chart(ctx, {
								  type: 'line',
								  data: {
								    labels: y,
								    datasets: [{
								      label: 'Metrics, x : Time, y : Value (1/20)',
								      data: x,
								      fill: true,
								      backgroundColor: "#3e92e680",
								      borderWidth: 1,
								    }]
								  },
								});

							</script>

							<?php
						}
					}
				}
			}
		}
		else
		{
			echo("No data for this building");
		}
	?>

</body>
</html>