<!DOCTYPE html>
<html>
<head>
    <title>Add sensors</title>
</head>
<body>

    <?php

        session_start();

        if(!isset($_SESSION['name_admin']))
        {
            header('Location: ../');
        }

        include ("mysql.php");

        if(isset($_GET['erreur']))
        {
            $err = $_GET['erreur'];
            if($err == 1)
            {
                echo("<div class='erreur'>Error while adding a sensor, please try again.</div>");
            }
            if($err == 2)
            {
                echo("<div class='erreur'>Please fill all the fields.</div>");
            }
            if($err == 3)
            {
                echo("<div class='erreur'>This sensor already exist.</div>");
            }
        }

        $bat = "SELECT id, nom FROM batiment";
        $result = mysqli_query($db, $bat);

        echo("Sensor's building : ");
        echo('<form action="envoie_add_cap.php" method="POST"><select name="batiment"><option value="">...</option>');

        for($i = 0; $i < mysqli_num_rows($result); $i++){
            $resBat = mysqli_fetch_assoc($result);
            $idBat = $resBat["id"];
            $nomBat = $resBat["nom"];
            echo("<option value='$idBat'>" . $nomBat . "</options>");
        }

        echo('</select><br /><br />');

    ?>

        <div class="text-form">Étage : </div>
        <input type="text" name="Floor" placeholder="Ex : 1">
        <br />
        <br />
        <div class="text-form">Salle : </div>
        <input type="text" name="Room" placeholder="Ex : E104">
        <br />
        <br />
        <div class="text-form">Sensor type : </div>
        <input type="text" name="type" placeholder="Ex : temperature">
        <input type="hidden" name="nomBat" value='<?php echo($nomBat);?>'>
        <br />
        <br />
        <input type="submit" value="Add sensor">
    </form>

    <br />
    <a href="./">Back</a>

</body>
</html>