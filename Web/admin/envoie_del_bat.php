<!DOCTYPE html>
<html lang="en">
<head>
    <title>Delete building</title>
</head>
<body>

    <?php

        session_start();

        if(!isset($_SESSION['name_admin']))
        {
            header('Location: ../');
        }

        include ("../mysql.php");

        $bat = mysqli_real_escape_string($db, htmlspecialchars($_POST['batiment']));  //testing if the admin is connected and redirecting to home if not

        if($bat == ""){
            header('Location: del_bat.php?erreur=1');               //manangin errors : if no building is selected
            exit;
        }

        $sqlMes = "DELETE mesure FROM mesure LEFT JOIN valeur ON valeur.id_mesure = mesure.id LEFT JOIN capteur ON valeur.id_capteur = capteur.id LEFT JOIN batiment ON capteur.batiment = batiment.id WHERE batiment.id = '$bat'";
        $sqlBat = "DELETE batiment FROM batiment WHERE batiment.id = '$bat'";               //deleting the building, and alos the floors, rooms, sensors and values in this specific building

        if(mysqli_query($db, $sqlMes)){
            if(mysqli_query($db, $sqlBat)){
                header("Location: confirm_del_bat.php");
                exit;
            }
            else
            {
                header("Location: del_bat.php?erreur=1");           //managing errors
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