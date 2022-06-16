<!DOCTYPE html>
<html>
<head>
    <title>Selection du bâtiment</title>
</head>
<body>

    <?php

        session_start();

        if(!isset($_SESSION['name_admin']))
        {
            header('Location: http://localhost/SAE23/');
        }

        if(isset($_GET['erreur']))
        {
            $err = $_GET['erreur'];
            if($err == 1)
            {
                echo("<div class='erreur'>Une erreur est survenue, réessayez.</div>");
            }
            if($err == 2)
            {
                echo("<div class='erreur'>Choisisez un bâtiment.</div>");
            }
        }

        $db_user = "root";
        $db_pass = "";
        $db_name = "sae23";
        $db_host = "localhost";

        $db = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

        $requete = "SELECT id, nom FROM batiment";
        $result = mysqli_query($db, $requete);

        echo("Choisisez le bâtiment du capteur à supprimer : ");
        echo('<form action="del_cap_form.php" method="POST">');

        echo('<select name="batiment"><option value="">...</option>');
        for($i = 0; $i < mysqli_num_rows($result); $i++){
            $res = mysqli_fetch_assoc($result);
            $idBat = $res["id"];
            $nomBat = $res["nom"];
            echo("<option value='$idBat'>" . $nomBat . "</options>");
        }
        echo('</select>');

        echo('<br /><br /><input type="submit" value="Choisir le bâtiment"></form>');

    ?>

    <br />
    <a href="/SAE23/admin">Revenir en arrière</a>

</body>
</html>