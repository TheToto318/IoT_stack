<!DOCTYPE html>
<html>
<head>
    <title>Suppression d'un capteur</title>
</head>
<body>

    <?php

        session_start();

        if(!isset($_SESSION['name_admin']))
        {
            header('Location: http://localhost/SAE23/');
        }

        $db_user = "root";
        $db_pass = "";
        $db_name = "sae23";
        $db_host = "localhost";

        $db = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

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
                echo("<div class='erreur'>Choisissez un capteur.</div>");
            }
        }

        $requete = "SELECT id, salle, etage, type FROM capteur WHERE batiment ='$bat'";
        $result = mysqli_query($db, $requete);

        echo("Choisisez le capteur à supprimer : ");
        echo('<form action="envoie_del_cap.php" method="POST">');

        echo('<select name="capteur"><option value="">...</option>');
        for($i = 0; $i < mysqli_num_rows($result); $i++){
            $resCap = mysqli_fetch_assoc($result);
            $idCap = $resCap["id"];
            $etageCap = $resCap["etage"];
            $salleCap = $resCap["salle"];
            $typeCap = $resCap["type"];
            echo("<option value='$idCap'>Etage " . $etageCap . ", salle " . $salleCap . ", capteur de " . $typeCap . "</options>");
        }
        echo('</select>');

        echo('<br /><br /><input type="submit" value="Supprimer le capteur"></form>');

    ?>

    <br />
    <a href="del_cap.php">Choisir un autre batiment</a>
    <br />
    <a href="/SAE23/admin">Revenir à l'administration</a>

</body>
</html>