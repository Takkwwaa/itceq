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

        textarea {
            width: 20vw;
            height: 100px;
            padding: 10px 15px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type=submit] {
            width: 25%;
            background-color: #0f0b4b;
            color: white;
            padding: 8px 5px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: #0f0b4b;
        }

        label {
            font-family: "poppins";
            color: #0f0b4b;
        }

        #global form {
            border-radius: 5px;
            background-color: #ccc;
            display: flex;
            flex-direction: column;
            width: 30vw;
            align-items: flex-start;
            padding: 15px;
            border-radius: 4px;
            box-shadow: 0 0 3px rgb(47, 45, 45);
            gap: 10px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Document</title>
</head>

<body>
    <div id="global">
        <form action="" method="POST" id="form" name="form">
            <label for="R">Votre probl??me est r??solu ?</label>
            <div style="display: flex; gap:13px;">
                <div>
                    <input type="radio" name="R" id="" value="V" selected> Vrai
                </div>
                <div>
                    <input type="radio" name="R" id="" value="F"> Faux
                </div>
            </div>
            <script>
                var test = false;
                var radios = document.forms["form"].elements["R"];
                for (var i = 0, max = radios.length; i < max; i++) {
                    radios[i].onclick = function() {
                        if (this.value == 'F' && test == false) {
                            test = true;
                            console.log(this.value);
                            var elem = document.createElement("textarea");
                            var f = document.getElementById('form');
                            var btn = document.getElementById('btn');
                            elem.setAttribute("id", "text");
                            elem.setAttribute("name", "txt");
                            elem.setAttribute("required", "true");
                            f.insertBefore(elem, btn);
                            let t = document.createTextNode("Donnez plus de d??tailles :");
                            var text = document.createElement("p");
                            text.setAttribute("id", "lib");
                            text.appendChild(t);
                            f.insertBefore(text, elem);
                        } else if (typeof(document.getElementById('text')) != 'undefined' && document.getElementById('text') != null && this.value != 4) {
                            test = false;
                            var txt = document.getElementById('text');
                            var lib = document.getElementById('lib');
                            txt.parentElement.removeChild(txt);
                            lib.parentElement.removeChild(lib);
                        }

                    }
                };
            </script>
            <input type="submit" value="Envoyer" name="submit" id="btn">
        </form>
    </div>
</body>

</html>

<?php
$con = mysqli_connect("localhost", "root", "root");
mysqli_select_db($con, "debugtracker");
$id = $_GET["mat"];
$verif = $_POST["R"];
$txt = $_POST["txt"];
if (isset($_POST["submit"]) && $verif == "F" && $txt == "") {
?><script>
        Swal.fire(
            'Il faut indiquer les d??tailles',
            '',
            'error'
        )
    </script><?
            } else if (isset($_POST["submit"]) && !isset($verif) && $txt == "") { ?>
    <script>
        Swal.fire(
            'Il faut envoyer une r??ponse valide',
            '',
            'error'
        )
    </script><?
            } else {
                if ($verif == "V") {
                    $res = mysqli_query($con, "UPDATE reclamation SET ID_etat='5' WHERE matricule=$id;");
                    if ($res) {
                ?>
            <script>
                Swal.fire(
                    'Merci',
                    '',
                    'success'
                );
            </script>
        <?
                    }
                } else {
                    $res = mysqli_query($con, "UPDATE reclamation SET ID_etat='6' WHERE matricule=$id;");
                    $res1 = mysqli_query($con, "SELECT * FROM reclamation WHERE matricule=$id;");
                    while ($tab = mysqli_fetch_row($res1)) {
                        $req = mysqli_query($con, "INSERT into commentaire values ($id,$tab[2],'Attention','$txt');");
        ?>
            <script>
                Swal.fire(
                    'Merci',
                    '',
                    'success'
                );
            </script>
<?
                    }
                }
            }
?>