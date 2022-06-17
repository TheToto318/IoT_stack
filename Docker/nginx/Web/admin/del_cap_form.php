<!DOCTYPE html>
<html>
<head>
    <title>Delete sensor</title>
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
            header("Location: del_cap.php?erreur=2");
            exit;
        }

        if(isset($_GET['erreur']))
        {
            $err = $_GET['erreur'];
            if($err == 1)
            {
                echo("<div class='erreur'>Select a sensor</div>");
            }
        }

        $requete = "SELECT id, salle, etage, type FROM capteur WHERE batiment ='$bat'";
        $result = mysqli_query($db, $requete);

        echo("Select a sensor to delete : ");
        echo('<form action="envoie_del_cap.php" method="POST">');

        echo('<select name="capteur"><option value="">...</option>');
        for($i = 0; $i < mysqli_num_rows($result); $i++){
            $resCap = mysqli_fetch_assoc($result);
            $idCap = $resCap["id"];
            $etageCap = $resCap["etage"];
            $salleCap = $resCap["salle"];
            $typeCap = $resCap["type"];
            echo("<option value='$idCap'>floor " . $etageCap . ", room " . $salleCap . ", type " . $typeCap . "</options>");
        }
        echo('</select>');

        echo('<br /><br /><input type="submit" value="Delete sensor"></form>');

    ?>

    <br />
    <a href="del_cap.php">Chose an other building</a>
    <br />
    <a href="./">Back to admin</a>

</body>
</html>