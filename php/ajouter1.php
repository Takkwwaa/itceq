<?php 
session_start();
if($_SESSION["user"]!="admin"){
    header("Location:http://127.0.0.1/debugtracker/php/resources.php");
    exit();
}?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
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
            h1{
                color:rgb(135, 30, 30);
                font-weight: 600;
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

        #global{
            border-radius: 5px;
            background-color:#ccc;
            display: flex;
            flex-direction: column;
            width: 30vw;
            align-items: flex-start;
            padding-left: 10px;
            border-radius: 4px;
            box-shadow: 0 0 3px rgb(47, 45, 45);
        }

    </style>
    <title>Document</title>
</head>
<?php
$con = mysqli_connect("localhost", "root", "root");
mysqli_select_db($con, "debugtracker");
$tab = mysqli_query($con, "SELECT nom,prenom,ID_agent FROM agent ;");
?>

<body>

    <div id="global">
    <h1>Ajouter :</h1>
        <form action="" method="POST">
            <table>
            <tr>
                <td><label for="nserie">Numéro série :</label></td>
                <td><input type="text" name="nserie"required></td>
            </tr>
            <tr>
                <td><label for="bureau">Bureau :</label></td>
                <td><input type="text" name="bureau" required></td>
            </tr>
            <tr>
                <td><label for="type">Utilisateur :</label></td>
                <td><select name='select' required>
                    <option value='NULL' selected>Utilisateur</option>
                    <? while ($agents = mysqli_fetch_row($tab)) { ?>
                        <option value=<?= $agents[2]; ?>><?= $agents[0] . "_" . $agents[1] ?> </option>
                    <? } ?>
                </select></td>
            </tr>
            <tr>
                <td><label for="pc">PC :</label></td>
                <td><input type="text" name="PC" required></td>
            </tr>
            <tr>
                <td><label for="date">Date d'aquisation :</label></td>
                <td><input type="date" name="date" required></td>
            </tr>
            </table>
            <input type="submit" value="confirmer" id='btn' name="btn">
        </form>
    </div>
</body>
<?php
$nserie = $_POST["nserie"];
$date = $_POST["date"];
$bureau = $_POST["bureau"];
$agent = $_POST['select'];
$pc = $_POST["PC"];
$req = mysqli_query($con, "INSERT INTO stock
(Nserie,PC,user,bureau,date_aqui)
 VALUES ('$nserie','$pc',$agent,$bureau,'$date');");?>
<script>
Swal.fire(
    'Matriel ajouté',
    '',
    'success'
  );
  </script>

</html>