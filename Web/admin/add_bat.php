<!DOCTYPE html>
<html>
<head>
    <title>Ajout d'un bâtiment</title>
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
                echo("<div class='erreur'>Erreur lors de l'ajout du batiment, réessayez.</div>");
            }
            if($err == 2)
            {
                echo("<div class='erreur'>Pour le login, respectez la forme 'Gestio-X' avec X le numéro du gestionnaire</div>");
            }
            if($err == 3)
            {
                echo("<div class='erreur'>Bâtiment déjà existant, réessayez.</div>");
            }
            if($err == 4)
            {
                echo("<div class='erreur'>Gestionnaire déjà existant, réessayez.</div>");
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
        <input type="submit" value="Ajouter le bâtiment">
    </form>

    <br />
    <a href="/SAE23/admin">Revenir en arrière</a>

</body>
</html>