<!DOCTYPE html>
<html lang="en">
<head>
	<title>Management</title>
	<link rel="stylesheet" href="../style/styleGestion.css">
</head>
<body>
	<script src="chart/chart.js"></script>		<!-- library used to print charts -->
	<script>
		var idGraph;
		var ctx;
		var myChart;		//creating the variables that will be used in the graphs
		var x;
		var y;
	</script>

	<?php

		include ("../mysql.php");
		session_start();
	
		if(isset($_SESSION['name_admin']))
		{
			unset($_SESSION['name_admin']);
		}

		if(!isset($_SESSION['name_gestion']))
		{
			header('Location: login_gestion.php');
		}

		if(isset($_POST['date1'])){
			$date1 = mysqli_real_escape_string($db,htmlspecialchars($_POST['date1']));		//checking which submited values are set to adapt future requests
		}
		if(isset($_POST['date2'])){
			$date2 = mysqli_real_escape_string($db,htmlspecialchars($_POST['date2']));
		}
		if(isset($_POST['date3'])){
			$date3 = mysqli_real_escape_string($db,htmlspecialchars($_POST['date3']));
		}
		if(isset($_POST['heure1'])){
			$heure1 = mysqli_real_escape_string($db,htmlspecialchars($_POST['heure1']));
		}
		if(isset($_POST['heure2'])){
			$heure2 = mysqli_real_escape_string($db,htmlspecialchars($_POST['heure2']));
		}


		echo('<div class="session">' . $_SESSION['name_gestion'] . '</div>');			//printing the manager's username

//--------------------------------------------------------------------------------------------------------------------//

		$user = $_SESSION['name_gestion'];

		$bat = "SELECT id, nom FROM batiment WHERE login = '$user'";					//selecting the building of the manager
		$result = mysqli_query($db, $bat);
		$numBat = mysqli_fetch_assoc($result);
		$bat = $numBat["id"];
		$nomBat = $numBat["nom"];

		$etage = "SELECT DISTINCT etage FROM capteur LEFT JOIN batiment ON capteur.batiment = batiment.id WHERE batiment.id = '$bat' ORDER BY etage";
		$result_etage = mysqli_query($db, $etage); 								// selecting the floors from the building of the manager

		echo('<div class="nomBat">' . "Building $nomBat" . '</div>');

		?>

		<nav>
			<ul>
				<li><a href="../">Home</a></li>
				<li><a href="deconnexion_gestion.php">Sign out</a></li>				<!-- navigation bar -->
			</ul>
		</nav>

		<?php

		//-------------------------------------------------//

		function axesGraph($tableau)											//function creating the absciss axis' values
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
				$salle = "SELECT DISTINCT salle FROM capteur WHERE capteur.etage = '$eta' AND capteur.batiment = '$bat'"; //selecting each rooms of each floor on the manager's building
				$result_salle = mysqli_query($db, $salle);

				for($b = 0; $b < mysqli_num_rows($result_salle); $b++)
				{
					$numSalle = mysqli_fetch_assoc($result_salle);
					$sal = $numSalle["salle"];

					echo('<div class="salle">' . "$sal" . '</div>');
					$capteur = "SELECT capteur.id, capteur.type FROM capteur WHERE capteur.salle = '$sal' AND capteur.etage = '$eta' AND capteur.batiment = '$bat'"; 				// selecting each sensor in each room of each floor in the manager's building
					$result_capteur = mysqli_query($db, $capteur);

					for($c = 0; $c < mysqli_num_rows($result_capteur); $c++)
					{
						$typecapteur = mysqli_fetch_assoc($result_capteur);
						$cap = $typecapteur["type"];
						$capId = $typecapteur["id"];

						echo('<div class="capteur">' . "$cap" . '</div>');

						// creating the query to select each value of each sensor of each room of each floor in the manager's building, depending on the selected time slot ( if selected ) 
            
						if(isset($date1) && isset($heure1) && isset($heure2)){
							$mesure = "SELECT date, heure, valeur FROM mesure LEFT JOIN valeur ON valeur.id_mesure = mesure.id LEFT JOIN capteur ON valeur.id_capteur = capteur.id WHERE capteur.id = '$capId' AND capteur.salle = '$sal' AND capteur.etage = '$eta' AND capteur.batiment = '$bat' AND date = '$date1' AND heure BETWEEN '$heure1' AND '$heure2' ORDER BY mesure.date DESC, mesure.heure DESC"; 	// getting values from a specific day between 2 chosen hours
						}
						elseif(isset($date2) && isset($date3)){
							$mesure = "SELECT date, heure, valeur FROM mesure LEFT JOIN valeur ON valeur.id_mesure = mesure.id LEFT JOIN capteur ON valeur.id_capteur = capteur.id WHERE capteur.id = '$capId' AND capteur.salle = '$sal' AND capteur.etage = '$eta' AND capteur.batiment = '$bat' AND date BETWEEN '$date2' AND '$date3' ORDER BY mesure.date DESC, mesure.heure DESC";
						}							//getting values between 2 chosen days
						else
						{
							$mesure = "SELECT date, heure, valeur FROM mesure LEFT JOIN valeur ON valeur.id_mesure = mesure.id LEFT JOIN capteur ON valeur.id_capteur = capteur.id WHERE capteur.id = '$capId' AND capteur.salle = '$sal' AND capteur.etage = '$eta' AND capteur.batiment = '$bat' ORDER BY mesure.date DESC, mesure.heure DESC";		//getting all the values
						}
						
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

							echo('<div class="box"><div class="tab"><table>');			//creating the table for each sensor

							echo("<tr><th>Date</th><th>Time</th><th>Value</th></tr>");

							for ($d = 0; $d < mysqli_num_rows($result_mesure); $d++)
							{
								$valmesure = mysqli_fetch_assoc($result_mesure);		//calculating the average, minimum and maximum values for each sensor
								$mesDate = $valmesure["date"];
								$mesHeure = $valmesure["heure"];
								$mesVal = $valmesure["valeur"];

								if($min == 0){$min = $mesVal;}

								if($cap == "temperature"){
									echo("<tr><td>$mesDate</td><td>$mesHeure</td><td>$mesVal °C</td></tr>");
								}
								if($cap == "co2"){
									echo("<tr><td>$mesDate</td><td>$mesHeure</td><td>$mesVal ppm</td></tr>");
								}

								
								$valHeure = explode(":", $mesHeure);
								list($heure, $minute, $seconde) = $valHeure;		//creating arrays to store data that will be used in charts

								if($countVal == 20){
									array_push($dataPoints, $mesVal);
									$countVal = 0;
								}

								$countVal += 1;

								if($countDate == 20){
									array_push($dataHours, "'$heure:$minute'");		//getting 1 value out of 20
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
              
							$dataPoints = array_reverse($dataPoints);	//reversing the arrays for the chart (last values at the right)
							$dataHours = array_reverse($dataHours);

							echo("</table></div>");

							$moyenne = $somme / $nbVal;

							if($cap == "temperature"){					//writing units depending on the type of data displayed
								$unite = " °C";
							}

							if($cap == "co2"){
								$unite = " ppm";
							}

							echo("<div class='mesures'><b>Statistics : </b><br />");	//printing average, minimum and maximum
							echo("<br />Average : " . round($moyenne, 2) . $unite);
							echo("<br />Maximum : " . $max . $unite);
							echo("<br />Minimum : " . $min . $unite . "</div>");
							
							$idChart = "$eta-$sal-$capId";
							echo("<div class ='graph'><canvas id=$idChart ></canvas></div></div>"); //printing the graph

							?>

							<!-- javascript code used to create the graph using Chart.js, a very cool library used to display charts easily -->

							<script>

								idGraph = "<?php echo $idChart ?>";
								ctx = document.getElementById(idGraph);
								x = <?php axesGraph($dataPoints); ?>; //getting the X and Y data from arrays in PHP
								y = <?php axesGraph($dataHours); ?>;

								myChart = new Chart(ctx, {			// creating the chart with specific options
								  type: 'line',
								  data: {
								    labels: y,
								    datasets: [{
								      label: 'Metrics, x : Time, y : Value (1/20) ',
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