<?php
session_start();
if ($_SESSION["user"] != "admin") {
  header("Location:http://127.0.0.1/debugtracker/php/dashboardprojets.php");
  exit();
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <title>Supprime</title>
</head>

<body>
<?php
$con = mysqli_connect("localhost", "root", "root");
mysqli_select_db($con, "debugtracker");
$id = $_GET["id"];
$req = mysqli_query($con, "DELETE FROM projets WHERE ID_projet=$id");
if (mysqli_query($con, $req)) {
?><script>
    Swal.fire(
      'Dossier supprimé',
      '',
      'success'
    ).then(function() {
      window.location = 'http://127.0.0.1/debugtracker/php/dashboardprojets.php';
    });
  </script>
<?
}
mysqli_close($con);
?>
</body>

</html>
<a href="http://127.0.0.1/debugtracker/php/supprime.php?id=<?= $tab[0] ?>">