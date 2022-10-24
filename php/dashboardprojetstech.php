<?php 
session_start();
if($_SESSION["user"]!="tech"){
    header("Location:http://127.0.0.1/debugtracker/php/logintech.php");
    exit();
}
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="http://127.0.0.1/debugtracker/css/style4.css" />

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
            </tr>
        </thead>
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
                <tr>
                    <td style="color:rgb(20, 3, 96);"><?= $tab[1] ?></td>
                    <td><?= $tab[2] ?></td>
                    <td><?= $tab[3] ?></td>
                    <td><?= $tyype[0] ?></td>
                    <td id="bttn"> <button type='submit' name="btn2"><?= get_np($con, $tab[5]) ?></button></td>
                    <td id="bttn"><button type='submit' name="btn1"><?= get_np($con, $tab[6]); ?></button></td>

                </tr>
        <?php


            }
        }
        $t=$_GET["idt"];
        $res = mysqli_query($con, "SELECT * FROM projets WHERE responsable=$t or responsable_assistant=$t;");
        if (mysqli_affected_rows($con) < 1) {
            ?>
            <script>Swal.fire({
    title: 'Vous etes pas concerné',
    text: '',
    icon: 'info',
    confirmButtonText: 'OK'
  })</script>
            
            <?
        }
        // while ($tab = mysqli_fetch_row($res)) {
        //     echo $tab[2];
        // }
        block($res, $con);

        ?>
    </table>

</body>

</html>