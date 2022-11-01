<?php
session_start();
if ($_SESSION["user"] != "tech") {
    header("Location:http://127.0.0.1/debugtracker/php/dashboardreclamtech.php");
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
    $req =  mysqli_query($con, "SELECT * FROM etat ;"); ?>
    <div id="global">
        <h3>Changer le statut :</h3>
        <form action="" method="POST" id="form" name="f">
            <select name='listetat' id='listetat' name='listetat'>
                <option value='NULL' selected>Statut</option>
                <? while ($tab = mysqli_fetch_row($req)) {
                    if ($tab[0] != 5 && $tab[0] != 6 && $tab[0] != 1) { ?>
                        <option value=<?= $tab[0] ?>><?= $tab[1]; ?> </option>
                <? }
                }
                echo $nptech[2] . '<br>'; ?>
                <script>
                    document.getElementById('listetat').addEventListener('change', function() {
                        if (this.value == 4) {
                            var elem = document.createElement("textarea");
                            var f = document.getElementById('form');
                            var btn = document.getElementById('btn');
                            elem.setAttribute("id", "text");
                            elem.setAttribute("name", "text");
                            elem.setAttribute("required", "true");
                            f.insertBefore(elem, btn);
                            let text = document.createTextNode("Donnez plus de détailles :");
                            text.setAttribute("id", "lib");
                            f.insertBefore(text,elem);}
                        else if(typeof(document.getElementById('text')) != 'undefined' && document.getElementById('text') != null && this.value != 4)
                        {
                            console.log(123);
                            var txt = document.getElementById('text');
                            var lib = document.getElementById('lib');
                            txt.parentElement.removeChild(txt);
                            txt.parentElement.removeChild(lib);
                        }
                    });
                </script>
                <input type="submit" value="confirmer" id='btn' name="btn">
    </div>
    </form>
    <?php
    if (isset($_POST['btn'])) {
        $id = $_GET["id"];
        $t = $_GET["t"];
        $idagent = $_GET["idagent"];
        $txt=$_POST["text"];
        $dest = mysqli_query($con, "SELECT email FROM agent WHERE ID_agent=$idagent;");
        if (mysqli_affected_rows($con) < 1) {
            echo "erreur" . "<br>" . mysqli_error($con);
        }
        $to = mysqli_fetch_row($dest);
        $etat = $_POST["listetat"];
        if ($etat == 3) {
            $msg = "Votre probléme a été bien resolu\n <a href='http://127.0.0.1/debugtracker/php/confirmation.php?mat=" . $id . "'>cliquer ici</a> pour confirmer que la probléme est résolu";
            $msg = wordwrap($msg, 70);
            $sub = "Confirmation ";
            $headers = "Content-Type: text/html;charset=utf-8\r\n";
            $headers .= "From: .$t.\r\n";
            echo $to[0];
            mail($to[0], $sub, $msg, $headers);
        }
        $res = mysqli_query($con, "UPDATE reclamation SET ID_etat=$etat WHERE matricule=$id;");
        $res1 = mysqli_query($con, "SELECT * FROM reclamation WHERE matricule=$id;");
        while ($tab = mysqli_fetch_row($res1)) {
            $req = mysqli_query($con, "INSERT into commentaire values ($id,$tab[2],'Bloqué','$txt');");}
        if ($res) {
    ?>
            <script>
                Swal.fire(
                    'Mise à jour fait avec succès',
                    '',
                    'success'
                ).then(function() {
                    window.location = 'http://127.0.0.1/debugtracker/php/dashboardreclamtech.php?idt=' + <?= $t ?>;
                });
            </script>
    <?
        } else {
            echo "erreur" . "<br>" . mysqli_error($con);
        }
    } ?>
    </select>
</body>

</html>