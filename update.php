<?php


if(empty($_GET["id"])){
    header("Location: index.php");
    exit();
    
}
$errors = [];

require_once("connectDB.php");
$pdo = connectDB();
$requete2 = $pdo->prepare("SELECT * FROM car WHERE id = :id;");
$requete2->execute([
    ":id" => $_GET["id"]
]);
$car = $requete2->fetch();

if ($car == false) {
    header("Location: index.php?Select=IdNotFound");
    exit();
}



if($_SERVER["REQUEST_METHOD"] == "POST"){

    if (empty($_POST["model"])) {
        $errors["model"] = "le modele de voiture est manquant";
    }
    if (empty($_POST["brand"])) {
        $errors["brand"] = "la marque de la voiture est manquante";
    }
    if (empty($_POST["horsePower"])) {
        $errors["horsePower"] = "la puissance du vehicule est manquante";
    }
    if (empty($_POST["image"])) {
        $errors["image"] = "l'image de la voiture est manquante";
    }

    if(empty($errors)){

        $requete = $pdo->prepare("UPDATE car SET model = :model, brand = :brand, horsePower = :horsePower, image = :image WHERE id = :id;");

        $requete->execute(
            [
                ":model" => $_POST["model"],
                ":brand" => $_POST["brand"],
                ":horsePower" => $_POST["horsePower"],
                ":image" => $_POST["image"],
                ":id" => $_GET["id"]
            ]

        );

      header("Location: index.php");
      exit();
    } 
}

$title = "Modifier " . $car["model"];
require_once("header.php");
?>
<h1 class="text-primary">Modifier <?php echo $car["brand"] ?> <?php echo $car["model"] ?> </h1>

<img src="images/<?php echo $car["image"] ?>" alt="<?php echo $car["model"] ?>">

<form method="POST" action="update.php?id=<?php echo($car["id"]) ?>">

    <label for="model">Model</label>
    <input id="model" type="text" name="model" value="<?php echo($car["model"])  ?>">
    <?php if (isset($errors['model'])): ?>
        <p class="text-danger"><?= $errors['model'] ?></p>
    <?php endif; ?>

    <label for="brand">Brand</label>
    <input type="text" name="brand" value="<?php echo($car["brand"])  ?>" >
    <?php if (isset($errors['brand'])): ?>
        <p class="text-danger"><?= $errors['brand'] ?></p>
    <?php endif; ?>

    <label for="horsePower">HorsePower</label>
    <input id="horsePower" type="number" name="horsePower" value="<?php echo($car["horsePower"])  ?>">
    <?php if (isset($errors['horsePower'])): ?>
        <p class="text-danger"><?= $errors['horsePower'] ?></p>
    <?php endif; ?>

    <label for="image">Image</label>
    <input id="image" type="text" name="image" >
    <?php if (isset($errors['image'])): ?>
        <p class="text-danger"><?= $errors['image'] ?></p>
    <?php endif; ?>

    <button class="btn btn-outline-success">Valider</button>

</form>
<?php
require_once("footer.php");
?>