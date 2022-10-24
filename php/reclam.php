<?php
$con=mysqli_connect("localhost","root","root");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
  }
  echo "Connected successfully"."<br>";
  mysqli_select_db($con,"debugtracker");
  $result = mysqli_query($con, "SELECT DATABASE()");
  $row = mysqli_fetch_row($result);
  printf("Default database is %s.\n", $row[0])."<br>";
  $lib=$_POST["lib_rec"];
  $desc=$_POST["desc"];
  $type=$_POST["type"];
  $deg=$_POST["degre"];
  $emaill=$_POST["email"];
  $date=date("Y-m-d");
  echo $desc;
  $req=mysqli_query($con,"SELECT * FROM agent WHERE email='$emaill';");
  $roww=mysqli_fetch_row($req);
  echo $roww[0];
//   mysqli_query($con,"INSERT INTO reclamation
//  (matricule,lib_rec,ID_agent,date, type, degre, description, ID_etat)
//   VALUES (NULL, '$lib', '$row[0]', '$date', '$type', '$deg', '$desc', '1');");
// if(mysqli_affected_rows($con)<1){echo "erreur". "<br>" . mysqli_error($con);}
// else echo"insertion bien fait";
?>
