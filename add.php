<?php
require_once("functions.php");
require_once("connectDB.php"); 

// Vérifier que l'utilisateur est connécté avec la présence
// D'un "username" en SESSION
verifySession();


$errors = [];
// Si le formulaire est validé
if ($_SERVER["REQUEST_METHOD"] == "POST") {

   $errors = validateCarForm($errors,$_POST);
    
    if (empty($errors)) {
        $pdo = connectDB();// Un seul connect DB par page
        // Ajouter la voiture et rediriger
        insertCar($pdo, $_POST["brand"], $_POST["model"], $_POST["horsePower"], $_POST["image"]);
        header("location: index.php");
    }
}


$title = "Ajouter une voiture";
require_once("header.php");
?>
<h1 class="text-success">Ajouter une voiture</h1>

<form method="POST" action="add.php" class="m-5">

    <label for="model">Model</label>
    <input id="model" type="text" name="model" value="<?= $_POST['model'] ?? '' ?>">
    <?php if (isset($errors['model'])): ?>
        <p class="text-danger"><?= $errors['model'] ?></p>
    <?php endif; ?>
    <label for="brand">Brand</label>
    <input type="text" name="brand" value="<?= $_POST['brand'] ?? '' ?>">
    <?php if (isset($errors['brand'])): ?>
        <p class="text-danger"><?= $errors['brand'] ?></p>
    <?php endif; ?>
    <label for="horsePower">HorsePower</label>
    <input id="horsePower" type="number" name="horsePower" value="<?= $_POST['horsePower'] ?? '' ?>">
    <?php if (isset($errors['horsePower'])): ?>
        <p class="text-danger"><?= $errors['horsePower'] ?></p>
    <?php endif; ?>
    <label for="image">Image</label>
    <input id="image" type="text" name="image" value="<?= $_POST['image'] ?? '' ?>">
    <?php if (isset($errors['image'])): ?>
        <p class="text-danger"><?= $errors['image'] ?></p>
    <?php endif; ?>
    <button class="btn btn-outline-success">Valider</button>

</form>





<?php
require_once("footer.php");
?>