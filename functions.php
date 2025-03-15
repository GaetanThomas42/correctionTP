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

/**
 * Récupère une voiture par son ID.
 *
 * @param PDO $pdo La connexion PDO.
 * @param int $id L'ID de la voiture.
 *
 * @example <p>
 * $pdo = connectDB();
 * $car = selectCarByID($pdo, 1); // $car Tableau associatif contenant les données de la voiture
 * </p>
 *
 * @return array|null Tableau associatif contenant les données de la voiture ou null si la voiture n'existe pas.
 */
function selectCarByID(PDO $pdo, int $id): ?array 
{
    $requete = $pdo->prepare("SELECT * FROM car WHERE id = :id;");
    $requete->execute([
        ":id" => $id
    ]);
    $car = $requete->fetch();
    
    if($car != false){
        return $car;
    }
    return null;

}

/**
 * Insère une voiture dans la base de données.
 *
 * @param PDO $pdo La connexion PDO.
 * @param string $brand La marque de la voiture.
 * @param string $model Le modèle de la voiture.
 * @param int $horsePower La puissance de la voiture.
 * @param string $image L'image de la voiture.
 *
 * @example <p>
 * $pdo = connectDB();
 * insertCar($pdo, "Renault", "Clio", 90, "clio.jpg");
 * </p>
 *
 * @return void
 */
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

/**
 * Met à jour une voiture dans la base de données.
 *
 * @param PDO $pdo La connexion PDO.
 * @param string $brand La marque de la voiture.
 * @param string $model Le modèle de la voiture.
 * @param int $horsePower La puissance de la voiture.
 * @param string $image L'image de la voiture.
 * @param int $id L'ID de la voiture.
 *
 * @example <p>
 * $pdo = connectDB();
 * updateCarByID($pdo, "Renault", "Clio", 90, "clio.jpg", 1);
 * </p>
 *
 * @return void
 */
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

/**
 * Supprime une voiture de la base de données.
 *
 * @param PDO $pdo La connexion PDO.
 * @param int $id L'ID de la voiture.
 *
 * @example <p>
 * $pdo = connectDB();
 * deleteCarByID($pdo, 1);
 * </p>
 *
 * @return void
 */
function deleteCarByID(PDO $pdo, int $id):void
{
    $requete = $pdo->prepare("DELETE FROM car WHERE id = :id;");
    $requete->execute([
        ":id" => $id
    ]);
}


/**
 * Vérifie si l'utilisateur n'est pas connecté redirection
 *
 * @example <p>
 * verifySession();
 * </p>
 *
 * @return void
 */
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

/**
 * Valide le formulaire en renvoyant un tableau d'erreurs.
 * @param array $errors Les erreurs du formulaire.
 * @param array $carForm Les données du formulaire.
 * @return array Les erreurs du formulaire.
 */
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



/**
 * Vérifie si l'ID n'est pas présent redirection.
 *
 * @param int $id L'ID à tester.
 *
 * @example <p>
 * verifyURLID($_GET["id"]);
 * </p>
 *
 * @return void
 */
function verifyURLID(int $id):void
{
    if(empty($id)){
        header("Location: index.php");
        exit();
    }
}

/**
 * Récupère un utilisateur par son username.
 * @param PDO $pdo La connexion PDO.
 * @param string $username Le nom d'utilisateur.
 * @return array|false Tableau associatif contenant les données de l'utilisateur ou false si l'utilisateur n'existe pas.
 */
function selectUserByUsername(PDO $pdo, string $username): array|null
{
    $requete = $pdo->prepare("SELECT * FROM user WHERE username = :username;");
    $requete->execute([
        ":username" => $username
    ]);
    $user = $requete->fetch();
    if($user != false){
        return $user;
    }
    return null;

}
?>