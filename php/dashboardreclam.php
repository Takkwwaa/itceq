<?php
session_start();
if ($_SESSION["user"] != "admin") {
    header("Location:http://127.0.0.1/debugtracker/php/loginadmin.php");
    exit();
}
$year = 60 * 60 * 60 * 24 * 365 + time();
setcookie('lastVisit', date("Y-m-d"), $year);
?>
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
    <script>
        $(document).ready(function() {
            $(".change").click(function() {
                Swal.fire({
                    title: 'Vous êtes sur!',
                    text: 'Tu veut vraiment réaffecter le travail',
                    icon: 'warning',
                    confirmButtonText: 'yes'
                });
            });
        });
    </script>
</head>

<body>
    <div class='tab'>
        <table>
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Agent</th>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Importance</th>
                    <th>Technicien</th>
                    <th colspan="2" style="text-align: center;">Statut</th>
                    <th>Infos</th>
                </tr>
            </thead>
            <?php
            $con = mysqli_connect("localhost", "root", "root");
            mysqli_select_db($con, "debugtracker");

            function block($res, $con)
            {
                while ($tab = mysqli_fetch_row($res)) {
                    $nomprenom = mysqli_query($con, "SELECT nom,prenom FROM agent WHERE ID_agent=$tab[2];");
                    if (mysqli_affected_rows($con) < 1) {
                        echo "erreur" . "<br>" . mysqli_error($con);
                    }
                    $etat = mysqli_query($con, "SELECT * FROM etat WHERE ID_etat=$tab[7];");
                    if (mysqli_affected_rows($con) < 1) {
                        echo "erreur" . "<br>" . mysqli_error($con);
                    }
                    $tab3 = mysqli_fetch_row($etat);
                    $tab1 = mysqli_fetch_row($nomprenom);
                    if ($tab[5] == 1) {
                        $degre = "Peu Important";
                        $color = "#2ecc71";
                    } elseif ($tab[5] == 2) {
                        $degre = "Important";
                        $color = "#f5bc42";
                    } else {
                        $degre = "Urgent";
                        $color = "#f54254";
                    }
                    switch ($tab3[0]) {
                        case 1:
                            $src = "http://127.0.0.1/debugtracker/img/saved.png";
                            break;
                        case 2:
                            $src = "http://127.0.0.1/debugtracker/img/settings-gear-svgrepo-com.svg";
                            break;
                        case 3:
                            $src = "http://127.0.0.1/debugtracker/img/checkmark_done_complete-512.webp";
                            break;
                        case 4:
                            $src = "http://127.0.0.1/debugtracker/img/error-svgrepo-com.svg";
                            break;
                        case 5:
                            $src = "http://127.0.0.1/debugtracker/img/verified.png";
                            break;
                        case 6:
                            $src = "http://127.0.0.1/debugtracker/img/warning.png";
                    }

            ?>
                    <tr>
                        <td style="width:170px"><?= $tab[1] ?></td>
                        <td><?= $tab1[0] . "_" . $tab1[1]  ?></td>
                        <td><?= $tab[3] ?></td>
                        <td><?= $tab[4] ?></td>
                        <td style="color:<?= $color ?> ;"><?= $degre ?></td>
                        <? if (isset($tab[8])) {
                            $nomprenomtech = mysqli_query($con, "SELECT nom,prenom FROM agent WHERE ID_agent=$tab[8];");
                            $tab4 = mysqli_fetch_row($nomprenomtech); ?>
                            <td id="bttn"> <a href='resporeclam.php?id=<?= $tab[0] ?>'><button type='submit' class="change"><?= $tab4[0] . "_" . $tab4[1] ?></button></a></td>
                        <?
                        } else { ?>
                            <td id="bttn"> <a href='resporeclam.php?id=<?= $tab[0] ?>'><button type='submit'>Sélectionner</button></a></td>
                        <? } ?>
                        <td style="padding: 0;"><img src="<?= $src ?>" height="15px" width="15px"></td>
                        <td style="padding-left:1px;"><?= $tab3[1] ?></td>
                        <td><a href="http://127.0.0.1/debugtracker/php/infos.php?id=<?=$tab[0]?>">savoir plus</a></td>
                    </tr>
            <?php
                }
            }
            // if (isset($_COOKIE['lastVisit'])) {
            //     $visit = $_COOKIE['lastVisit'];
            //     $res = mysqli_query($con, "SELECT * FROM reclamation WHERE date > '$visit';");
            //     block($res, $con);
            // } else {
            //     $res = mysqli_query($con, "SELECT * FROM reclamation;");
            //     block($res, $con);
            // }
            $res = mysqli_query($con, "SELECT * FROM reclamation ORDER BY date DESC;");
            block($res, $con);

            ?>
        </table>
    </div>
</body>

</html>