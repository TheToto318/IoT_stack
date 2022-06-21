<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add building</title>
</head>
<body>

    <?php

        session_start();

        if(!isset($_SESSION['name_admin']))                                       //testing if the admin is connected and redirecting to home if not
        {
            header('Location: ../');
        }

        include ("../mysql.php");

        $nom = mysqli_real_escape_string($db, htmlspecialchars($_POST["nom"]));             //getting all the values selected from the previous page
        $login = mysqli_real_escape_string($db, htmlspecialchars($_POST["login"]));
        $mdp = mysqli_real_escape_string($db, htmlspecialchars($_POST["mdp"]));
        $pass = password_hash($mdp, PASSWORD_BCRYPT);                                       //encrypting the written password when adding the building

        $verif = "SELECT nom, login FROM batiment";
        $resultVerif = mysqli_query($db, $verif);

        for($i = 0; $i < mysqli_num_rows($resultVerif); $i++){
            $row = mysqli_fetch_assoc($resultVerif);
            if($row["nom"] == $nom){                                                        //checking if the building already exists
                header("Location: add_bat.php?erreur=3");
                exit;
            }
            if($row["login"] == $login){                                                    //checking if the building's manager already exists
                header("Location: add_bat.php?erreur=4");
                exit;
            }
        }

        if($nom == "" || $login == "" || $mdp == ""){                                       //managing errors
            header('Location: add_bat.php?erreur=1');
            exit;
        }
        else
        {
            if(substr($login, 0, 7) != 'Gestio-'){                                          //managing errors : the manager's name has to be 'Gestio-' and a specific string
                header('Location: add_bat.php?erreur=2');
                exit;
            }
            else
            {
                $sql = "INSERT INTO batiment (nom, login, mdp) VALUES ('$nom', '$login', '$pass')"; //if all the informations are valid, the building is created
                $result = mysqli_query($db, $sql);
                if($result == 1)
                {
                    header('Location: confirm_bat.php');
                    exit;
                }
                else
                {
                    header('Location: add_bat.php?erreur=1');                           //if the query didn't work, an error is sent
                    exit;
                }
            }
        }

    ?>

</body>
</html>