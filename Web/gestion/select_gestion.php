<!DOCTYPE html>
<html lang="en">
<head>
    <title>Time slot</title>
    <link rel="stylesheet" href="../style/stylePlage.css">
</head>
<body>

    <div class="bandeau">Time slot</div>
    <nav>
        <ul>
            <li><a href="../">Home</a></li>
            <li><a href="../admin/login_admin.php">Admin</a></li>
            <li><a href="login_gestion.php">Management</a></li>
            <li><a href="../consultation.php">Overview</a></li>
            <li><a href="../mentions_legales.php">Terms of service</a></li>
        </ul>
    </nav>

    <?php

        session_start();

        if(!isset($_SESSION['name_gestion']))                   //checking if a manager is connected
        {
            header('Location: ../');
        }

        include ("../mysql.php");

        if(isset($_GET['erreur']))                              //managing errors
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

    ?>

    <!-- Three forms are created here :  - One that lets you select data from a specific day and between 2 chosen hours
                                    - One that lets you select data between 2 chosen days
                                    - One that selects all the values of a buidling -->

    <div class='form' style='color : white'>
        <form action="index.php" method="POST">
            <div class='ele1'><div class="text-form">Select a specific day : </div>
            <input type="date" name="date1" required></div>
            <div class="ele2">Between<br />
            <input type="time" name="heure1" required>
            <div class="text-form"> and </div>
            <input type="time" name="heure2" required></div>
            <div class="submit1"><input type="submit" value="Select time slot"></div>
        </form>

        <form action="index.php" method="POST">
            <div class="text-form2">--------- OR ---------<br /><br /></div>
            <div class="ele3"><div class="text-form3">Select days : </div></div>
            <div class="ele4">Between<br />
            <input type="date" name="date2" required>
            <div class="text-form"> and </div>
            <input type="date" name="date3" required></div>
            <div class="submit2"><input type="submit" value="Select time slot"></div>
        </form>

        <form action="index.php" method="POST">
            <div class="text-form4">--------- OR ---------<br /><br /></div>
            <div class="ele3"><div class="text-form5">Show all values</div></div>
            <div class="submit3"><input type="submit" value="Show all"></div>
        </form>
    </div>

</body>
</html>