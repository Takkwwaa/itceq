<?php 
session_start();
if($_SESSION["user"]!="tech"){
    header("Location:http://127.0.0.1/debugtracker/php/connecte1.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="http://127.0.0.1/debugtracker/css/style3.css" />
</head>

<? $t=$_GET["idt"];?>
<body>
<div class="first">
   <a href="http://127.0.0.1/debugtracker/php/exit.php"> <img src="http://127.0.0.1/debugtracker/img/logout-svgrepo-com.svg" alt="exit"width="40px" title="Exit"></a>
        <h1>ESPACE TECHNICIEN</h1></div>
    <div class="box1">
        <a href="http://127.0.0.1/debugtracker/php/dashboardreclamtech.php?idt=<?= $t ?>" target="window"><button>Reclamations</button></a>
        <a href="http://127.0.0.1/debugtracker/php/dashboardprojetstech.php?idt=<?= $t ?>" target="window"><button>Dossier Info</button></a>
        <a href="http://127.0.0.1/debugtracker/php/resourcestech.php ?>" target="window"><button>Resources</button></a>
    </div>
    <div class="box2"> <iframe src="http://127.0.0.1/debugtracker/php/dashboardreclamtech.php?idt=<?= $t ?>" id="iframe" name="window"></iframe></div>
</body>

</html>