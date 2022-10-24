<?php
session_start();
if($_SESSION["user"]!="admin"){
    header("Location:http://127.0.0.1/debugtracker/php/dashboardprojets.php");
    exit();
}
$con = mysqli_connect("localhost", "root", "root");
mysqli_select_db($con, "debugtracker"); ?>
<!DOCTYPE html>
<html lang="en">    
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://127.0.0.1/debugtracker/css/style5.css"> 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Document</title>
</head>

<body>
    
    <?
    $tab = mysqli_query($con, "SELECT nom,prenom,ID_agent FROM agent WHERE fonction<>'Directeur';");
    if (mysqli_affected_rows($con) < 1) {
        echo "erreur" . "<br>" . mysqli_error($con);
    } ?>
    <div id="global">
    <h3>Travail affecté à :</h3>
    <form action="" method="POST">
        <select name='list'>
            <option value='NULL' selected>Affecté a</option>
            <? while ($agents = mysqli_fetch_row($tab)) { ?>
                <option value=<?= $agents[2] ?>><?= $agents[0] . "_" . $agents[1] ?> </option>
            <? }?>
            <input type="submit" value="confirmer" id='btn' name="btn">
    </form></div>
    <?php
    if (isset($_POST["btn"])) {
        $id1 = $_GET["id1"];
        $agent = $_POST["list"];
        $res = mysqli_query($con, "UPDATE projets SET responsable_assistant=$agent WHERE ID_projet=$id1;");
        if ($res) {
            echo "
            <script>Swal.fire(
                'Mise à jour fait avec succès',
                '',
                'success'
              ).then(function() {
                window.location = 'http://127.0.0.1/debugtracker/php/dashboardprojets.php';
            });</script>
                ";
            
        } else {
            echo "erreur" . "<br>" . mysqli_error($con);
        }}?>
    </select>
</body>

</html>