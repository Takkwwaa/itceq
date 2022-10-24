<?php 
session_start();
if($_SESSION["user"]!="tech"){
    header("Location:http://127.0.0.1/debugtracker/php/logintech.php");
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
</head>

<body>
    <div class='tab'>
        <table>
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Agent</th>
                    <th style="width: 117px;">Date</th>
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
                    if (isset($tab[8])) {
                        $nomprenom2 = mysqli_query($con, "SELECT nom,prenom FROM agent WHERE ID_agent=$tab[8];");
                        if (mysqli_affected_rows($con) < 1) {
                            echo "erreur" . "<br>" . mysqli_error($con);
                        }
                        $tab2 = mysqli_fetch_row($nomprenom2);
                    }
                    else{ $tab2="_";}
                    $etat = mysqli_query($con, "SELECT lib_etat FROM etat WHERE ID_etat=$tab[7];");
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
                    switch($tab3[0]){
                        case 1:
                            $src="http://127.0.0.1/debugtracker/img/saved.png";
                            break;
                        case 2:
                            $src="http://127.0.0.1/debugtracker/img/settings-gear-svgrepo-com.svg";
                            break;
                        case 3:
                            $src="http://127.0.0.1/debugtracker/img/checkmark_done_complete-512.webp";
                            break;
                        case 4:
                            $src="http://127.0.0.1/debugtracker/img/error-svgrepo-com.svg";
                            break;
                        case 5:
                            $src="http://127.0.0.1/debugtracker/img/verified.png";
                            break;
                        case 6:
                            $src = "http://127.0.0.1/debugtracker/img/warning.png";
                    }
            ?>
                    <tr>
                        <td style="width:200px"><?= $tab[1] ?></td>
                        <td style="width: 100px;"><?= $tab1[0] . "_" . $tab1[1]  ?></td>
                        <td style="width: 117px;"><?= $tab[3] ?></td>
                        <td><?= $tab[4] ?></td>
                        <td style="color:<?= $color ?> ;"> <?= $degre ?></td>
                        <?
                        $t = $_GET["idt"];
                        if ($tab[8] == $t) { ?>
                            <td>Vous</td>
                            <td id="bttn" colspan="2" style="text-align: center;"><a href='update.php?id=<?= $tab[0] ?>&t=<?=$t?>&idagent=<?=$tab[2]?>'><button type='submit'><?= $tab3[0] ?></button></a></td>
                            
                        <? } else { ?>
                            <td><?= $tab2[0] . "_" . $tab2[1]  ?></td>
                            <td style="padding: 0;"><img src="<?=$src?>" alt="" height="15px" width="15px"></td>
                            <td style="padding-left:1px;"><?= $tab3[0] ?></td>
                            
                        <? } ?>
                        <td><a href="http://127.0.0.1/debugtracker/php/infostech.php?id=<?=$tab[0]?>">savoir plus</a></td>

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
            if (mysqli_affected_rows($con) < 1) {
                echo "erreur" . "<br>" . mysqli_error($con);
            }
            block($res, $con);
            ?>
        </table>
    </div>
</body>

</html>