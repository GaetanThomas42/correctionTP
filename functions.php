<?php

/** @param PDO $pdo La connexion à ma BDD  
*/
function selectAllCars(PDO $pdo):array
{   
    $requete = $pdo->prepare("SELECT * FROM car;");
    $requete->execute();
    $cars = $requete->fetchAll();
    return $cars;
}

?>