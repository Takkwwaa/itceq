<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="http://127.0.0.1/debugtracker/css/style1.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="http://127.0.0.1/debugtracker/js/verif1.js">
    </script>
    <style>@import url('https://fonts.googleapis.com/css2?family=Montserrat&family=Poppins&display=swap');

* {
    box-sizing: border-box;
}

body {
    margin: 0%;
    width: 100vw;
    height: auto;
    padding: 0%;
    overflow: visible;
}
.section1 {
    display: flex;
    margin-top: 60px;
}
.section1 .box1 {
 padding-left: 50px;
}
/* .section1 .box1 #elem2{
    margin-top: 80px;
   } */
.section1 .box3 {
    display: flex;
    flex-grow: 1;
    align-items: center;
    justify-content: center;
}

.section1 .box3 #fix {
    max-height: 500px;
    max-width: 500px;
    align-self: flex-start;
    justify-self: flex-start;
}
.soussection{
    display: flex;
    gap: 50px;
}
.section2{
    width: 40vw;
    display:flex ;
    flex-direction: row;
    flex-wrap: wrap;
}
.box4{ display: flex;
    flex-direction: column;
    flex-grow: 1;
    align-items: center;
    justify-content: center;
}
form h1 {
    display: inline-block;
    font-size: 20px;
    left: 50%;
    font-family: 'Montserrat', sans-serif;
    letter-spacing: 1px;
    color: rgb(34, 22, 80);
    font-weight: 700;
}

.red {
    display: inline-block;
    color: red;
}

form input[type=submit] {
    border-style: solid 2px;
    border-radius: 4px;
    width: 120px;
    height: 30px;
    font-family: "poppins";
    font-weight: 500;
    margin-top: 15px;
    border-color: #616161;
    margin-right: 7px;
}
form input[type=button]{
    border-style: solid 2px;
    border-radius: 4px;
    width: 120px;
    height: 30px;
    font-family: "poppins";
    font-weight: 500;
    margin-top: 15px;
    border-color: #616161;
}
form input[type=text],
select {
    width: 300px;
    height: 50px;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

form textarea {
    width: 300px;
    height: 100px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}
.flex-header {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 100px;
}
.flex-header img {
    max-width: 115px;
    max-height: 87px;
}
form p,
label {
    font-family: 'poppins';
    font-size: smaller;
    font-weight: 500;
    color: #0a032c;
    margin-bottom: 9px;
    margin-top: 30px;
}

form hr {
    margin-bottom: 30px;
    color: #181818;
}
</style>
</head>

<body>
    <form name="f" action="" method="post" onsubmit="controle()">
        <div class="flex-header">
            <h1>INSTITUT TUNISIEN DE LA COMPETITIVITE ET DES ETUDES QUANTITATIVES</h1>
            <img src="http://127.0.0.1/debugtracker/img/logoo.png">
        </div>
        <hr width="70%">
        <section class="section1">
            <div class="section2">
                <section class="soussection">
                    <div class="box1">
                        <p> Entrer le titre de votre reclamation
                            <span style="color: red;">*</span> :
                        </p>
                        <input type="text" name="lib_rec" id="lib_rec" required>
                        <p> Description du probléme
                            <span style="color: red;">*</span> :
                        </p>
                        <textarea name="desc" id="desc" cols="30" rows="10" required></textarea>

                        <p> Votre Email
                            <span style="color: red;">*</span> :
                        </p>
                        <input type="text" name="email" id="email" required>
                    </div>
                    <div class="box2">
                        <p> Sélectionner le type
                            <span style="color: red;">*</span> :
                        </p>
                        <select name="type" id="type" required>
                            <option value="type" selected>Type</option>
                            <option value="materiel">Materiel</option>
                            <option value="logiciel">Logiciel</option>
                        </select>
                        <p>Degré d'importance :</p>
                        <div name="radio">
                            <input type="radio" name="degre" value="1"><label for="1">Faible</label>
                            <input type="radio" name="degre" value="2"><label for="1">Moyen</label>
                            <input type="radio" name="degre" value="3"><label for="1">Fort</label>
                        </div>
                    </div>
                </section>
                <div class="box4">
                    <p><span style="color: red;">*</span> : champs obligatoires</p>
                    <div>
                    <input type="submit" value="Envoyer">
                    <a href="http://127.0.0.1/debugtracker/php/index.html"><input type="button" value="Retour"></a></div>
                </div>
            </div>
            <div class="box3"><img src="http://127.0.0.1/debugtracker/img/reclam.png" id="fix"></div>
        </section>
    </form>
</body>
<?php
$con = mysqli_connect("localhost", "root", "root");
mysqli_select_db($con, "debugtracker");
$lib = $_POST["lib_rec"];
$desc = $_POST["desc"];
$type = $_POST["type"];
$deg = $_POST["degre"];
$emaill = $_POST["email"];
$date = date("Y-m-d");
$req = mysqli_query($con, "SELECT * FROM agent WHERE email='$emaill';");
$roww = mysqli_fetch_row($req);
mysqli_query($con, "INSERT INTO reclamation
 (matricule,lib_rec,ID_agent,date, type, degre, description, ID_etat)
  VALUES (NULL, '$lib', '$roww[0]', '$date', '$type', '$deg', '$desc', '1');");
if ((mysqli_affected_rows($con) < 1) && ((isset($_POST['submit'])))) {
    echo "<script>
    Swal.fire({
    title: 'Erreur!',
    text: 'Votre Reclamation na pas été enregistrer verifier votre Email',
    icon: 'error',
    confirmButtonText: 'OK'
  })</script>";
} else echo "<script>Swal.fire(
    'Reclamation Enregistrer',
    '',
    'success'
  )</script>";
?>

</html>