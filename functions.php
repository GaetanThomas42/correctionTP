<?php

/**
 * Récupère toutes les voitures de la base de données.
 *
 * @param PDO $pdo La connexion PDO.
 *
 * @example <p>
 * $pdo = connectDB();
 * $cars = selectAllCars($pdo); // $cars Tableau associatif contenant les données de la table car
 * </p>
 *
 * @return array Tableau associatif contenant les voitures.
 */
function selectAllCars(PDO $pdo):array
{   
    $requete = $pdo->prepare("SELECT * FROM car;");
    $requete->execute();
    $cars = $requete->fetchAll();
    return $cars;
}

function selectCarByID(PDO $pdo, int $id): array|false
{
    $requete = $pdo->prepare("SELECT * FROM car WHERE id = :id;");
    $requete->execute([
        ":id" => $_GET["id"]
    ]);
    return $requete->fetch();

}

function insertCar(PDO $pdo, string $brand, string $model, int $horsePower, string $image):void
{
    $requete = $pdo->prepare("INSERT INTO car (model,brand,horsePower,image) VALUES (:model,:brand,:horsePower,:image);");
        $requete->execute(
            [
                ":model" => $model,
                ":brand" => $brand,
                ":horsePower" => $horsePower,
                ":image" => $image
            ]
        );
}

function updateCarByID(PDO $pdo, string $brand, string $model, int $horsePower, string $image, int $id):void
{
    $requete = $pdo->prepare("UPDATE car SET model = :model, brand = :brand, horsePower = :horsePower, image = :image WHERE id = :id;");
    $requete->execute(
        [
            ":model" => $model,
                ":brand" => $brand,
                ":horsePower" => $horsePower,
                ":image" => $image,
                ":id" => $id
        ]
    );
}
function deleteCarByID(PDO $pdo, int $id):void
{
    $requete = $pdo->prepare("DELETE FROM car WHERE id = :id;");
    $requete->execute([
        ":id" => $id
    ]);
}


function verifySession():void
{
    if(!isset($_SESSION)){
        session_start();
    }
    if(!isset($_SESSION["username"])){
        header("Location: index.php");
        exit();
    }
}

function validateCarForm(array $errors, array $carForm):array
{
    if (empty($carForm["model"])) {
        $errors["model"] = "le modele de voiture est manquant";
    }
    if (empty($carForm["brand"])) {
        $errors["brand"] = "la marque de la voiture est manquante";
    }
    if (empty($carForm["horsePower"])) {
        $errors["horsePower"] = "la puissance du vehicule est manquante";
    }
    if (empty($carForm["image"])) {
        $errors["image"] = "l'image de la voiture est manquante";
    }
     return $errors;
}


function verifyURLID(int $id):void
{
    if(empty($id)){
        header("Location: index.php");
        exit();
    }
}

function verifyCarExist(bool|array $car):void
{
    if ($car == false) {
        header("Location: index.php?Select=IdNotFound");
        exit();
    }
}

function selectUserByUsername(PDO $pdo, string $username): array|false
{
    $requete = $pdo->prepare("SELECT * FROM user WHERE username = :username;");
    $requete->execute([
        ":username" => $username
    ]);
    return $requete->fetch();

}
?>