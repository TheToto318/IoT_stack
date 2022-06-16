<!DOCTYPE html>
<html>
<head>
    <title>Envoie du capteur</title>
</head>
<body>

    <?php

        session_start();

        if(!isset($_SESSION['name_admin']))
        {
            header('Location: ../');
        }

        $db_user = "root";
        $db_pass = "";
        $db_name = "sae23";
        $db_host = "localhost";

        $db = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

        $capteur = mysqli_real_escape_string($db, htmlspecialchars($_POST['capteur']));

        if($capteur == ""){
            header("Location: del_cap_form.php?erreur=1");
            exit;
        }

        echo($capteur);

        $sqlMes = "DELETE mesure FROM mesure LEFT JOIN valeur ON valeur.id_mesure = mesure.id LEFT JOIN capteur ON valeur.id_capteur = capteur.id WHERE capteur.id = '$capteur'";
        $sqlCap = "DELETE capteur FROM capteur WHERE capteur.id = '$capteur'";

        if(mysqli_query($db, $sqlMes)){
            if(mysqli_query($db, $sqlCap)){
                header("Location: confirm_del_cap.php");
                exit;
            }
            else
            {
                header("Location: del_cap.php?erreur=1");
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