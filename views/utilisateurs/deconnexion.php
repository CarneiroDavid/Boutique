<?php
$_SESSION = array();//Ecrase tableau de session 
session_unset(); //Detruit toutes les variables de la session en cours
session_destroy();//Destruit la session en cours
header("location:MaPage.php"); // redirige l'utilisateur