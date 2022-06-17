<!DOCTYPE html>
<html>
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

        if(isset($_GET['erreur']))
        {
            $err = $_GET['erreur'];
            if($err == 1)
            {
                echo("<div class='erreur'>An error occurred, please try again</div>");
            }

        }

        $bat = "SELECT id, nom FROM batiment";
        $result = mysqli_query($db, $bat);

        echo("Select the building to delete : ");
        echo('<form action="envoie_del_bat.php" method="POST"><select name="batiment"><option value="">...</option>');

        for($i = 0; $i < mysqli_num_rows($result); $i++){
            $resBat = mysqli_fetch_assoc($result);
            $idBat = $resBat["id"];
            $nomBat = $resBat["nom"];
            echo("<option value='$idBat'>" . $nomBat . "</options>");
        }

        echo('</select><br /><br /><input type="submit" value="Delete building"></form>');

    ?>

    <br />
    <a href="./">Back</a>

</body>
</html>