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

        $nom = mysqli_real_escape_string($db, htmlspecialchars($_POST["nom"]));
        $login = mysqli_real_escape_string($db, htmlspecialchars($_POST["login"]));
        $mdp = mysqli_real_escape_string($db, htmlspecialchars($_POST["mdp"]));
        $pass = password_hash($mdp, PASSWORD_BCRYPT);

        $verif = "SELECT nom, login FROM batiment";
        $resultVerif = mysqli_query($db, $verif);

        for($i = 0; $i < mysqli_num_rows($resultVerif); $i++){
            $row = mysqli_fetch_assoc($resultVerif);
            if($row["nom"] == $nom){
                header("Location: add_bat.php?erreur=3");
                exit;
            }
            if($row["login"] == $login){
                header("Location: add_bat.php?erreur=4");
                exit;
            }
        }

        if($nom == "" || $login == "" || $mdp == ""){
            header('Location: add_bat.php?erreur=1');
            exit;
        }
        else
        {
            if(substr($login, 0, 7) != 'Gestio-'){
                header('Location: add_bat.php?erreur=2');
                exit;
            }
            else
            {
                $sql = "INSERT INTO batiment (nom, login, mdp) VALUES ('$nom', '$login', '$pass')";
                $result = mysqli_query($db, $sql);
                if($result == 1)
                {
                    header('Location: confirm_bat.php');
                    exit;
                }
                else
                {
                    header('Location: add_bat.php?erreur=1');
                    exit;
                }
            }
        }

    ?>

</body>
</html>