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

        $bat = mysqli_real_escape_string($db, htmlspecialchars($_POST['batiment']));

        if($bat == ""){
            header('Location: del_bat.php?erreur=1');
            exit;
        }

        $sqlMes = "DELETE mesure FROM mesure LEFT JOIN valeur ON valeur.id_mesure = mesure.id LEFT JOIN capteur ON valeur.id_capteur = capteur.id LEFT JOIN batiment ON capteur.batiment = batiment.id WHERE batiment.id = '$bat'";
        $sqlBat = "DELETE batiment FROM batiment WHERE batiment.id = '$bat'";

        if(mysqli_query($db, $sqlMes)){
            if(mysqli_query($db, $sqlBat)){
                header("Location: confirm_del_bat.php");
                exit;
            }
            else
            {
                header("Location: del_bat.php?erreur=1");
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