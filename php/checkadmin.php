<?php 
session_start();
$_SESSION["user"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Document</title>
</head>

<body>
</body>
</html>
<?php
$con = mysqli_connect("localhost", "root", "root");
mysqli_select_db($con, "debugtracker");
$mail = $_POST["email"];
$mdps = $_POST["pass"];
$res = mysqli_query($con, "SELECT ID_agent FROM user,agent WHERE email_user='$mail' and email='$mail'and fonction='Directeur' and mdps='$mdps';");
if (mysqli_num_rows($res) > 0) {
    $tab = mysqli_fetch_row($res);
    $_SESSION["user"]="admin";
?>
    <script>
        Swal.fire(
            'Connecté avec succès',
            '',
            'success',
        ).then(function() {
            window.location = 'http://127.0.0.1/debugtracker/php/loginadmin.php';
        });
    </script>
<?
} else {
?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Erreur !',
            text: 'Verifier votre paramétres de connexion',
            showConfirmButton: false,
            timer: 2500
        }).then(function() {
            window.location = 'http://127.0.0.1/debugtracker/php/connecte.html';
        });
    </script>";<?
            }
                ?>