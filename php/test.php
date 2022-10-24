<?php 

$to="takwahosnitkd@gmail.com";
$sub="this is a text";
$msg="hehehehehe";

$headers="Content-Type: text/plain;charset=utf-8\r\n";
$headers.="From: takwahosnitkd@gmail.com\r\n";

if (mail($to,$sub,$msg,$headers))
echo "envoyer";
else
echo"erreur envoi";
?>