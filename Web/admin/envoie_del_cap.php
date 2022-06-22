<!DOCTYPE html>
<html lang="en">
<head>
    <title>Delete sensor</title>
</head>
<body>

    <?php

        session_start();

        if(!isset($_SESSION['name_admin']))                     //testing if the admin is connected and redirecting to home if not
        {
            header('Location: ../');
        }

        include ("../mysql.php"); 

        $capteur = mysqli_real_escape_string($db, htmlspecialchars($_POST['capteur']));     //getting all the values selected from the previous page

        if($capteur == ""){
            header("Location: del_cap_form.php?erreur=1");              //managing errors : if no sensor is selected
            exit;
        }

        echo($capteur);

        $sqlMes = "DELETE mesure FROM mesure LEFT JOIN valeur ON valeur.id_mesure = mesure.id LEFT JOIN capteur ON valeur.id_capteur = capteur.id WHERE capteur.id = '$capteur'";
        $sqlCap = "DELETE capteur FROM capteur WHERE capteur.id = '$capteur'";  //deleting the sensor and the values related to this specific sensor

        if(mysqli_query($db, $sqlMes)){
            if(mysqli_query($db, $sqlCap)){
                header("Location: confirm_del_cap.php");
                exit;
            }
            else
            {
                header("Location: del_cap.php?erreur=1");               //managing errors
                exit;
            }
        }
        else
        {
            header("Location: del_bat.php?erreur=1");
            exit;
        }

    ?>

</body>
</html>