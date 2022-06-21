<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add building</title>
    <link rel="stylesheet" href="../style/styleAdmin.css">
</head>
<body>

    <div class="bandeau">Add building</div>
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

        if(!isset($_SESSION['name_admin']))                 //testing if the admin is connected and redirecting to home if not
        {
            header('Location: ../');
        }

        include ("../mysql.php");

        if(isset($_GET['erreur']))                          //Showing errors if the submited informations are not valideted 
        {
            $err = $_GET['erreur'];
            if($err == 1)
            {
                echo("<div class='erreur'>An error occured while adding a building</div>");
            }
            if($err == 2)
            {
                echo("<div class='erreur'>Please use following pattern for login : 'Gestio-X' (X : Manager ID)</div>");
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
  
    <div class="form">
        <form action="envoie_add_bat.php" method="POST">
            <div class="ele1"><input type="text" name="nom" placeholder="RT"></div>
            <div class="ele2"><input type="text" name="login" placeholder="Gestio-X"></div>
            <div class="ele3"><input type="password" name="mdp" placeholder="password"></div>
            <div class="submit"><input type="submit" value="Add building"></div>
        </form>
    </div>
</body>
</html>