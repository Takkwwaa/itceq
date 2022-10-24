<?php 
session_start();
if($_SESSION["user"]!="admin"){
    header("Location:http://127.0.0.1/debugtracker/php/connecte.html");
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
    <link rel="stylesheet" href="http://127.0.0.1/debugtracker/css/style3.css" />
</head>
<body>
    <div class="first">
   <a href="http://127.0.0.1/debugtracker/php/exit.php"> <img src="http://127.0.0.1/debugtracker/img/logout-svgrepo-com.svg" alt="exit"width="40px" title="Exit"></a>
        <h1>ESPACE ADMINISTRATION</h1></div>
        <div class="box1"> 
        <a href="http://127.0.0.1/debugtracker/php/dashboardreclam.php" target="window"><button>Reclamations</button></a>
        <a href="http://127.0.0.1/debugtracker/php/dashboardprojets.php" target="window"><button>Dossier Info</button></a>
        <a href="http://127.0.0.1/debugtracker/php/resources.php ?>" target="window"><button>Resources</button></a>
    </div>
    <div class="box2"> <iframe src="http://127.0.0.1/debugtracker/php/dashboardreclam.php" id="iframe" name="window"></iframe></div>
</body>

</html>