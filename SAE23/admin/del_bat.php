<!DOCTYPE html>
<html>
<head>
    <title>Suppression d'un bâtiment</title>
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
                echo("<div class='erreur'>Une erreur est survenue, réessayez.</div>");
            }

        }

        $bat = "SELECT id, nom FROM batiment";
        $result = mysqli_query($db, $bat);

        echo("Choisisez le bâtiment à supprimer : ");
        echo('<form action="envoie_del_bat.php" method="POST"><select name="batiment"><option value="">...</option>');

        for($i = 0; $i < mysqli_num_rows($result); $i++){
            $resBat = mysqli_fetch_assoc($result);
            $idBat = $resBat["id"];
            $nomBat = $resBat["nom"];
            echo("<option value='$idBat'>" . $nomBat . "</options>");
        }

        echo('</select><br /><br /><input type="submit" value="Supprimer le bâtiment"></form>');

    ?>

    <br />
    <a href="/SAE23/admin">Revenir en arrière</a>

</body>
</html>