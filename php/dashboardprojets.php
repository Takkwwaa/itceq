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
    <title>Dashboard</title>
    <link rel="stylesheet" href="http://127.0.0.1/debugtracker/css/style4.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <table>
        <thead>
            <tr>
                <th>Titre</th>
                <th>Date_Debut</th>
                <th>Date_Fin</th>
                <th>Type</th>
                <th>Responsable</th>
                <th>Responsable_Assistant</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tr>
            <td colspan="7" id="bttn1" style="height: 60px;"><a href="http://127.0.0.1/debugtracker/php/ajouter.php"><button id="add">+ Nouveau</button></a></td>
        </tr>
        <?php
        $con = mysqli_connect("localhost", "root", "root");
        mysqli_select_db($con, "debugtracker");
        $id = NULL;
        $id1 = NULL;
        function get_np($con, $idagent)
        {
            $nomprenom = mysqli_query($con, "SELECT nom,prenom FROM agent WHERE ID_agent=$idagent;");
            if (mysqli_affected_rows($con) < 1) {
                echo "erreur" . "<br>" . mysqli_error($con);
            }
            $tab = mysqli_fetch_row($nomprenom);
            return $tab[0] . "_" . $tab[1];
        }
        function block($res, $con)
        {
            while ($tab = mysqli_fetch_row($res)) {

                $type = mysqli_query($con, "SELECT lib_type FROM type WHERE ID_type=$tab[4];");
                if (mysqli_affected_rows($con) < 1) {
                    echo "erreur" . "<br>" . mysqli_error($con);
                }
                $tyype = mysqli_fetch_row($type);

                if (mysqli_affected_rows($con) < 1) {
                    echo "erreur" . "<br>" . mysqli_error($con);
                }
        ?>
                <tr id="<?= $tab[0]?>">
                    <td style="color:rgb(20, 3, 96) ;"><?= $tab[1] ?></td>
                    <td><?= $tab[2] ?></td>
                    <td><?= $tab[3] ?></td>
                    <td><?= $tyype[0] ?></td>
                    <? if (isset($tab[5])) { ?>
                        <td id="bttn"> <a href='respo.php?id=<?= $tab[0] ?>'><button type='submit' name="btn2"><?= get_np($con, $tab[5]) ?></button></a></td>
                    <? } else { ?>
                        <td id="bttn"> <a href='respo.php?id=<?= $tab[0] ?>'><button type='submit' name="btn2">Sélectionner</button></a></td>
                    <? }
                    if (isset($tab[6])) { ?>
                        <td id="bttn"><a href='respo1.php?id1=<?= $tab[0] ?>'><button type='submit' name="btn1"><?= get_np($con, $tab[6]); ?></button></a></td>
                    <? } else { ?>
                        <td id="bttn"><a href='respo1.php?id1=<?= $tab[0] ?>'><button type='submit' name="btn1">Sélectionner</button></a></td> <? } ?>
                    <td><button id="bin"><img src="http://127.0.0.1/debugtracker/img/corbeille.png" style="width: 30px;height: 30px;"></button><input type="hidden" name="id"></td>
                </tr>
                <script>
                    document.getElementById('bin').addEventListener('click', function() {
                                const xmlhttp = new XMLHttpRequest();
                                xmlhttp.open("POST", "http://127.0.0.1/debugtracker/php/supprime.php?id=" +<?= $tab[0]?>,true);
                                xmlhttp.send();
                                e=document.getElementById(<?=$tab[0]?>);
                                e.parentElement.removeChild(e);
                            }
                            )
                </script>
        <?php


            }
        }

        $res = mysqli_query($con, "SELECT * FROM projets ;");
        block($res, $con);
        ?>
    </table>

</body>

</html>