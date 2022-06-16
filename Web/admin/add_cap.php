<!DOCTYPE html>
<html>
<head>
    <title>Ajout d'un capteur</title>
</head>
<body>

    <?php

        session_start();

        if(!isset($_SESSION['name_admin']))
        {
            header('Location: /SAE23/');
        }

        $db_user = "root";
        $db_pass = "";
        $db_name = "sae23";
        $db_host = "localhost";

        $db = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

        if(isset($_GET['erreur']))
        {
            $err = $_GET['erreur'];
            if($err == 1)
            {
                echo("<div class='erreur'>Erreur lors de l'ajout du capteur, vérifiez vos valeurs et réessayez.</div>");
            }
            if($err == 2)
            {
                echo("<div class='erreur'>Tous les champs ne sont pas remplis</div>");
            }
            if($err == 3)
            {
                echo("<div class='erreur'>Ce capteur existe déjà.</div>");
            }
        }

        $bat = "SELECT id, nom FROM batiment";
        $result = mysqli_query($db, $bat);

        echo("Bâtiment dans lequel le capteur sera ajouté : ");
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
        <input type="text" name="etage" placeholder="Ex : 1">
        <br />
        <br />
        <div class="text-form">Salle : </div>
        <input type="text" name="salle" placeholder="Ex : E104">
        <br />
        <br />
        <div class="text-form">Type de capteur : </div>
        <input type="text" name="type" placeholder="Ex : temperature">
        <input type="hidden" name="nomBat" value='<?php echo($nomBat);?>'>
        <br />
        <br />
        <input type="submit" value="Ajouter le capteur">
    </form>

    <br />
    <a href="/SAE23/admin">Revenir en arrière</a>

</body>
</html>