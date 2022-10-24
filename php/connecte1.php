<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>loginadmin</title>
    <script src="http://127.0.0.1/debugtracker/js/verif.js"></script>
    <link rel="stylesheet" href="http://127.0.0.1/debugtracker/css/style.css" />
</head>

<body>
    <div class="main">
        <div class="section">
            <a href="http://127.0.0.1/debugtracker//php/index.html" class="back"><img src="http://127.0.0.1/debugtracker/img/back.png" alt="" width="30px">Retour</a>
            <form action="http://127.0.0.1/debugtracker/php/checkuser.php" method="POST" name="f" id="form" onsubmit="test()">
                <p> Se Connecter</p>
                <div class="mail">
                    <label for="email">Email :</label>
                    <input type="email" name="email" id="email" required placeholder=" Votre Email..">
                </div>
                <div class="pass">
                    <label for="pass"> Mot de passe :</label>
                    <input type="password" name="pass" id="pass" placeholder=" Votre mot de passe.." required>
                </div>
                <div class="buttons">
                    <input type="submit" value="Connecter" class="btn">
                    <input type="reset" value="Annuler">
                </div>
            </form>
        </div>
        <div class="photo">
            <img src="http://127.0.0.1/debugtracker/img/undraw_login_re_4vu2 (1).svg">
        </div>
    </div>
</body>