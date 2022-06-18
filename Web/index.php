<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" href="style/style.css">
</head>
<body>

	<div class="bandeau">Home</div>
	<nav>
        <ul>
            <li><a href="admin/login_admin.php">Admin</a></li>
            <li><a href="gestion/login_gestion.php">Management</a></li>
            <li><a href="consultation.php">Overview</a></li>
            <li><a href="mentions_legales.php">Terms of service</a></li>
        </ul>
    </nav>

    <div class="description">
    	
    	<div class="w">W</div>elcome to the <div class="projet">IoT_Stack</div> dynamic website, this webpage is a part of the SAE23 project initiated by the Blagnac college and made by four students :<br />
		- Roques Clément (Frontend developer)<br />
		- Roux Thomas (Backend developer)<br />
		- Naissant Mattieu (Frontend developer)<br />
		- Chauvet Matthias (Frontend developer)<br /><br />

		The purpose of this website is to manage the IOT system of the Blagnac college which includes : <br />
		- Severals building, floors and rooms<br />
		- Sensors of various types : temperature, co2 and luminosity<br /><br />

		<div class ="gauche"><a href="media/Vue_Concepteur.png"><img src="media/Vue_Concepteur.png" alt="Conceptor view of the database."></a></div>

		Metrics are recovered from an MQTT broker by a PHP script embedded into a docker container and sent to a MariaDB database. <br />
		These metrics are generated every minute by a Bash script in a docker container before being sent to the MQTT broker.<br /><br />

		This website runs thanks to an Apache Web server also integrated into a docker container.<br /><br />

		An other part of this project consists in processing these metrics with nodeRED associated with InfluxDB + Grafana for visualization.<br />
		These services are accessible with the following URL :<br />
		- nodeRED : https://sae23.cloudroux.ovh/nodered/<br />
		- Grafana : https://sae23.cloudroux.ovh/grafana/<br /><br />

		PHPMyAdmin, the database management interface used by this website is also accesible with this URL : https://sae23.cloudroux.ovh/phpmyadmin/<br /><br />

		<div class="droite">
			<a href="media/Grafana.png"><img src="media/Grafana.png" alt="Grafana"></a>
		</div>

		The complete workflow to recover and manage these metric is dockerized and can be run with only one command using docker-compose. <br /><br />

		Images are customized and uploaded into our Docker Hub repository : https://hub.docker.com/r/totorx/sae23<br /><br />

		The whole stack is hosted on Thomas's server to be reachable from internet with the "sae23.cloudroux.ovh" domain name.<br /><br /> 

		For more information, take a look at our Github page : https://github.com/TheToto318/IoT_stack<br /><br />

		Thanks to the different tabs above you will be able to : <br />
		- Add/delete buildings to monitor with an associated manager account (only for administrator).<br />
		- Add/delete sensors with associated floor and room (only for administrator).<br />
		- See the last metrics recovered without authentication. (on the overview page).<br />
		- See metrics history for all rooms with graphs by logging with a manager credentials.<br /> <br />

		This website uses the following languages : <br />
		- HTML<br />
		- CSS<br />
		- PHP<br />
		- JavaScript<br />

    </div>

</body>
</html>