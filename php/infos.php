<?php
session_start();
if ($_SESSION["user"] != "admin") {
    header("Location:http://127.0.0.1/debugtracker/php/dashboardreclam.php");
    exit();
}?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat&family=Poppins&display=swap&family=Roboto+Condensed&display=swap');

        * {
            margin: 0;
            font-family: "poppins";
        }

        html {
            width: 100vw;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: white;
        }

        h1 {
            color: rgb(135, 30, 30);
            align-content: center;
            justify-content: center;
        }

        input[type=text],
        select,
        [type=date] {
            width: 200px;
            padding: 10px 15px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type=submit] {
            width: 30%;
            background-color: rgb(20, 3, 96);
            color: white;
            padding: 10px 15px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: #0f0b4b;
        }

        #global {
            border-radius: 5px;
            background-color: #ccc;
            display: flex;
            flex-direction: column;
            width: 30vw;
            align-items: flex-start;
            border-radius: 4px;
            box-shadow: 0 0 3px rgb(47, 45, 45);
            gap: 8px;
            padding: 10px;
        }
        #box{
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: white;
            border-radius:  10px 100px / 120px;
            height: auto;
            width: 25vw;
            padding: 12px;
        }
        #sbox{
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }
        #sbox p{color: rgb(31, 1, 108);}
    </style>
    <title>Informations</title>
</head>

<body>
    <?php
    $con = mysqli_connect("localhost", "root", "root");
    mysqli_select_db($con, "debugtracker"); 
    function get_np($con, $idagent)
        {
            $nomprenom = mysqli_query($con, "SELECT nom,prenom FROM agent WHERE ID_agent=$idagent;");
            if (mysqli_affected_rows($con) < 1) {
                echo "erreur" . "<br>" . mysqli_error($con);
            }
            $tab = mysqli_fetch_row($nomprenom);
            return $tab[0] . "_" . $tab[1];
        }
    $mat=$_GET["id"];
    $res=mysqli_query($con,"SELECT * from reclamation where matricule=$mat;");
    $tab=mysqli_fetch_row($res);
    $res1=mysqli_query($con,"SELECT text from commentaire where matricule=$mat and ID_agent=$tab[2] and etat='Bloqué';");
    $tab1=mysqli_fetch_row($res1);
    $res2=mysqli_query($con,"SELECT text from commentaire where matricule=$mat and ID_agent=$tab[2] and etat='Attention';");
    $tab2=mysqli_fetch_row($res2);
    $agent='NULL';
    $tech='NULL';
    if(isset($tab[2])){
    $agent=get_np($con,$tab[2]);}
    if(isset($tab[8])){
    $tech=get_np($con,$tab[8]);}
    ?>
    <div id="global">
<h1><?= $tab[1]?></h1>
<h4> Description :</h4>
<p id="box"><?= $tab[6]?></p>
<div id="sbox"><h4>Technicien :</h4><p><?=$tech?></p></div>
<?if (isset($tab1[0])){?>
<p id="box"><?=$tab1[0]?></p>
<?}else{?><p id="box">Aucun commentaire.</p><?}?>
<div id="sbox"><h4>Agent :</h4><p><?=$agent?></p></div>
<?if (isset($tab2[0])){?>
<p id="box"><?=$tab2[0]?></p><?}else{?><p id="box">Aucun commentaire.</p><?}?>
    </div>
</body>

</html>
<?php

?>