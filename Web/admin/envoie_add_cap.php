<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add sensor</title>
</head>
<body>

    <?php

        session_start();

        if(!isset($_SESSION['name_admin']))                                     //testing if the admin is connected and redirecting to home if not
        {
            header('Location: ../');
        }

        include ("../mysql.php");

        $batiment = mysqli_real_escape_string($db, htmlspecialchars($_POST["batiment"]));     //getting all the values selected from the previous page
        $etage = mysqli_real_escape_string($db, htmlspecialchars($_POST["etage"]));
        $salle = mysqli_real_escape_string($db, htmlspecialchars($_POST["salle"]));
        $type = strtolower(mysqli_real_escape_string($db, htmlspecialchars($_POST["type"])));

        $verif = "SELECT salle, etage, type, batiment FROM capteur";                //checking if the sensor already exists
        $resultVerif = mysqli_query($db, $verif);
        $reqBat = "SELECT nom FROM batiment WHERE id = '$batiment'";
        $resultBat = mysqli_query($db, $reqBat);
        $listBat = mysqli_fetch_assoc($resultBat);
        $nomBat = $listBat["nom"];

        for($i = 0; $i < mysqli_num_rows($resultVerif); $i++){
            $row = mysqli_fetch_assoc($resultVerif);
            if($row["batiment"] == $batiment && $row["etage"] == $etage && $row["salle"] == $salle && $row["type"] == $type){
                header("Location: add_cap.php?erreur=3");
                exit;
            }
        }


        if($batiment == "..." || $etage == "" || $salle == "" || $type == ""){
            header('Location: add_cap.php?erreur=2');                               // managing errors : all the values are not set
            exit;
        }

        $topic = "iut/$nomBat/etage$etage/$salle/$type";                            //creating the topic for MQTT
        $requete = "INSERT INTO capteur (salle, etage, type, batiment, topic) VALUES ('$salle', '$etage', '$type', '$batiment', '$topic')";

        $result = mysqli_query($db, $requete);
            if($result == 1)
            {
                header('Location: confirm_cap.php');
                exit;
            }
            else
            {
                header('Location: add_cap.php?erreur=1');                   //mananing errors : if the query didn't work.
                exit;
            }

    ?>

</body>
</html>












