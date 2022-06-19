<!DOCTYPE html>
<html>
<html lang="en">
<head>
    <title>Add sensors</title>
    <link rel="stylesheet" href="../style/styleAdmin.css">
</head>
<body>

    <div class="bandeau">Add sensor</div>
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

        include ("../mysql.php");

        if(isset($_GET['erreur']))
        {
            $err = $_GET['erreur'];
            if($err == 1)
            {
                echo("<div class='erreur'>Error while adding a sensor, please try again.</div>");
            }
            if($err == 2)
            {
                echo("<div class='erreur'>Please fill all the fields.</div>");
            }
            if($err == 3)
            {
                echo("<div class='erreur'>This sensor already exist.</div>");
            }
        }

        $bat = "SELECT id, nom FROM batiment";
        $result = mysqli_query($db, $bat);

        echo("<div class='form3' style='color : white'><div class='ele1'>Sensor's building : ");
        echo('<form action="envoie_add_cap.php" method="POST"><select name="batiment"><option value="">...</option>');

        for($i = 0; $i < mysqli_num_rows($result); $i++){
            $resBat = mysqli_fetch_assoc($result);
            $idBat = $resBat["id"];
            $nomBat = $resBat["nom"];
            echo("<option value='$idBat'>" . $nomBat . "</options>");
        }

        echo('</select></div>');

    ?>
        <div class="ele2"><div class="text-form">Floor : </div>
        <input type="text" name="etage" placeholder="Ex : 1"></div>
        <div class="ele3"><div class="text-form">Room : </div>
        <input type="text" name="salle" placeholder="Ex : E104"></div>
        <div class="ele4"><div class="text-form">Sensor type : </div>
        <input type="text" name="type" placeholder="Ex : temperature"></div>
        <div class="submit"><input type="submit" value="Add sensor">
    </form>
</div>

</body>
</html>