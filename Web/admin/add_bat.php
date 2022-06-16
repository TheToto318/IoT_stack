<!DOCTYPE html>
<html>
<head>
    <title>Add building</title>
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
                echo("<div class='erreur'>An error occured while adding a building</div>");
            }
            if($err == 2)
            {
                echo("<div class='erreur'>Please use fallowing pattern for login : 'Gestio-X' (X : Manager ID)</div>");
            }
            if($err == 3)
            {
                echo("<div class='erreur'>Building already exist, please try again.</div>");
            }
            if($err == 4)
            {
                echo("<div class='erreur'>Manager already exist, please try again.</div>");
            }
        }

    ?>

    <p>Ajout d'un batiment</p>

    <form action="envoie_add_bat.php" method="POST">
        <input type="text" name="nom" placeholder="RT">
        <br />
        <input type="text" name="login" placeholder="Gestio-X">
        <br />
        <input type="password" name="mdp" placeholder="password">
        <br />
        <input type="submit" value="Add building">
    </form>

    <br />
    <a href="./">Back</a>

</body>
</html>