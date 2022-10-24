<?php
session_start();
if ($_SESSION["user"] != "admin") {
    header("Location:http://127.0.0.1/debugtracker/php/loginadmin.php");
    exit();
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rasources</title>
    <link rel="stylesheet" href="http://127.0.0.1/debugtracker/css/style4.css" />
</head>

<body>
    <div class='tab'>
        <table>
            <thead>
                <tr>
                    <th>Num série</th>
                    <th>PC</th>
                    <th>Utilisateur</th>
                    <th>Bureau</th>
                    <th>Date d'aquisation</th>
                </tr>

            </thead>
            <tr>
                <td colspan="5" id="bttn1" style="height: 60px;"><a href="http://127.0.0.1/debugtracker/php/ajouter1.php"><button id="add">+ Nouveau</button></a></td>
            </tr>
            <?php
            $con = mysqli_connect("localhost", "root", "root");
            mysqli_select_db($con, "debugtracker");

            function block($res, $con)
            {
                while ($tab = mysqli_fetch_row($res)) {
                    $nomprenom = mysqli_query($con, "SELECT nom,prenom FROM agent WHERE ID_agent=$tab[2];");
                    $tab1 = mysqli_fetch_row($nomprenom);
            ?>

                    <tr>
                        <td><?= $tab[0] ?></td>
                        <td><?= $tab[1]  ?></td>
                        <td><?= $tab1[0] . "_" . $tab1[1] ?></td>
                        <td><?= $tab[3] ?></td>
                        <td><?= $tab[4] ?></td>
                    </tr>
            <?php


                }
            }
            $res = mysqli_query($con, "SELECT * FROM stock ORDER BY date_aqui DESC;");
            if (mysqli_affected_rows($con) < 1) {
                echo "erreur" . "<br>" . mysqli_error($con);
            }
            block($res, $con);
            ?>
        </table>
    </div>
</body>

</html>