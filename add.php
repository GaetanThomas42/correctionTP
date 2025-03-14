<?php
// Vérifier que l'utilisateur est connécté avec la présence
// D'un "username" en SESSION
session_start();
if(!isset($_SESSION["username"])){
    header("Location: index.php");
    exit();
}

$title = "Ajouter une voiture";
require_once("header.php");

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $model = $_POST["model"];
    $brand = $_POST["brand"];
    $horsePower = $_POST["horsePower"];
    $image = $_POST["image"];

    if (empty($model)) {
        $errors["model"] = "le modele de voiture est manquant";
    }
    if (empty($brand)) {
        $errors["brand"] = "la marque de la voiture est manquante";
    }
    if (empty($horsePower)) {
        $errors["horsePower"] = "la puissance du vehicule est manquante";
    }
    if (empty($image)) {
        $errors["image"] = "l'image de la voiture est manquante";
    }

    

    if (empty($errors)) {
        require_once("connectDB.php");
        $pdo = connectDB();
        $requete = $pdo->prepare("INSERT INTO car (model,brand,horsePower,image) VALUES (:model,:brand,:horsePower,:image);");
        $requete->execute(
            [
                ":model" => $model,
                ":brand" => $brand,
                ":horsePower" => $horsePower,
                ":image" => $image
            ]
        );
        header("location: index.php");

    }
}
?>
<h1 class="text-success">Add</h1>

<form method="POST" action="add.php" class="m-5">

    <label for="model">Model</label>
    <input id="model" type="text" name="model">
    <?php if (isset($errors['model'])): ?>
        <p class="text-danger"><?= $errors['model'] ?></p>
    <?php endif; ?>
    <label for="brand">Brand</label>
    <input type="text" name="brand">
    <?php if (isset($errors['brand'])): ?>
        <p class="text-danger"><?= $errors['brand'] ?></p>
    <?php endif; ?>
    <label for="horsePower">HorsePower</label>
    <input id="horsePower" type="number" name="horsePower">
    <?php if (isset($errors['horsePower'])): ?>
        <p class="text-danger"><?= $errors['horsePower'] ?></p>
    <?php endif; ?>
    <label for="image">Image</label>
    <input id="image" type="text" name="image">
    <?php if (isset($errors['image'])): ?>
        <p class="text-danger"><?= $errors['image'] ?></p>
    <?php endif; ?>
    <button class="btn btn-outline-success">Valider</button>

</form>





<?php
require_once("footer.php");
?>