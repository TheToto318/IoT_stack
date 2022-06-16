<!DOCTYPE html>
<html>
<head>
    <title>Select building</title>
</head>
<body>

    <?php

        session_start();

        if(!isset($_SESSION['name_admin']))
        {
            header('Location: ../');
        }

        if(isset($_GET['erreur']))
        {
            $err = $_GET['erreur'];
            if($err == 1)
            {
                echo("<div class='erreur'>An error occurred, please try again.</div>");
            }
            if($err == 2)
            {
                echo("<div class='erreur'>Select a building</div>");
            }
        }

        include ("mysql.php");

        $requete = "SELECT id, nom FROM batiment";
        $result = mysqli_query($db, $requete);

        echo("Select the building's sensor to delete : ");
        echo('<form action="del_cap_form.php" method="POST">');

        echo('<select name="batiment"><option value="">...</option>');
        for($i = 0; $i < mysqli_num_rows($result); $i++){
            $res = mysqli_fetch_assoc($result);
            $idBat = $res["id"];
            $nomBat = $res["nom"];
            echo("<option value='$idBat'>" . $nomBat . "</options>");
        }
        echo('</select>');

        echo('<br /><br /><input type="submit" value="Select building"></form>');

    ?>

    <br />
    <a href="./">Back</a>

</body>
</html>