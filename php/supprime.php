<?php
session_start();
if ($_SESSION["user"] != "admin") {
  header("Location:http://127.0.0.1/debugtracker/php/dashboardprojets.php");
  exit();
} 
$con = mysqli_connect("localhost", "root", "root");
mysqli_select_db($con, "debugtracker");
$id = $_REQUEST["id"];
$req = mysqli_query($con, "DELETE FROM projets WHERE ID_projet=$id");
mysqli_close($con);
?>