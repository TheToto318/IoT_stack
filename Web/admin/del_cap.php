<!DOCTYPE html>
<html>
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

        echo("<div class='form2'><div class='form-text2'>Select the building's sensor you want to delete : </div>");
        echo('<form action="del_cap_form.php" method="POST">');

        echo('<div class="ele1"><select name="batiment"><option value="">...</option>');
        for($i = 0; $i < mysqli_num_rows($result); $i++){
            $res = mysqli_fetch_assoc($result);
            $idBat = $res["id"];
            $nomBat = $res["nom"];
            echo("<option value='$idBat'>" . $nomBat . "</options>");
        }
        echo('</select>');

        echo('</select></div><div class="submit2"><input type="submit" value="Select building"></form></div></div>');

    ?>

</body>
</html>