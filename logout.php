<?php

session_start();

if(isset($_SESSION["username"])){
    //Supprime une variable
    unset($_SESSION["username"]);    
}

//Vide les données de la session en conservant la même session
//session_reset();

//Détruit la session totale, une nouvelle session sera créée avec un nouvelle ID
//session_destroy();

header("Location: index.php")

?>