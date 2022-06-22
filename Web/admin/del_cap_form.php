<!DOCTYPE html>
<html lang="en">
<head>
    <title>Delete sensor</title>
    <link rel="stylesheet" href="../style/styleAdmin.css">
</head>
<body>

    <div class="bandeau">Delete sensor</div>
    <nav>
        <ul>
            <li><a href="../">Home</a></li>
            <li><a href="login_admin.php">Admin</a></li>
            <li><a href="../gestion/login_gestion.php">Management</a></li>
            <li><a href="../consultation.php">Overview</a></li>
            <li><a href="../mentions_legales.php">Terms of service</a></li>
        </ul>
    </nav>

    <?php

        session_start();

        if(!isset($_SESSION['name_admin']))                 //testing if the admin is connected and redirecting to home if not
        {
            header('Location: ../');
        }

        include ("../mysql.php"); 

        $bat = mysqli_real_escape_string($db, htmlspecialchars($_POST['batiment']));    //getting the building where the sensor you want to delete is from the previous page

        if($bat == ""){
            header("Location: del_cap.php?erreur=2");                           //managing errors : if no building was selected
            exit;
        }

        if(isset($_GET['erreur']))
        {
            $err = $_GET['erreur'];                                             //managing errors
            if($err == 1)
            {
                echo("<div class='erreur'>Select a sensor</div>");
            }
        }

        $requete = "SELECT id, salle, etage, type FROM capteur WHERE batiment ='$bat'";     //selecting the sensors from the previously chosen building
        $result = mysqli_query($db, $requete);

        echo("<div class='form2'><div class='form-text2'>Select a sensor to delete : </div>");
        echo('<form action="envoie_del_cap.php" method="POST">');

        echo('<div class="ele1"><select name="capteur"><option value="">...</option>');
        for($i = 0; $i < mysqli_num_rows($result); $i++){
            $resCap = mysqli_fetch_assoc($result);
            $idCap = $resCap["id"];
            $etageCap = $resCap["etage"];
            $salleCap = $resCap["salle"];
            $typeCap = $resCap["type"];
            echo("<option value='$idCap'>floor " . $etageCap . ", room " . $salleCap . ", type " . $typeCap . "</options>");
        }

        echo('</select></div><div class="submit2"><input type="submit" value="Delete sensor"></form></div></div>'); //sending inforamtions to the next page

    ?>

    <br />
    <div class="back">
        <a href="del_cap.php">Chose an other building</a>
        <br />
        <a href="./">Back to admin</a>
    </div>

</body>
</html>