<?php
require_once("connectDB.php");
require_once("functions.php");

// Vérifier que l'utilisateur est connécté avec la présence
// D'un "username" en SESSION
verifySession();
//Vérifier si l'ID est présent dans l'url
verifyURLID($_GET["id"]);

$pdo = connectDB();
$car = selectCarByID($pdo, $_GET["id"]); // Un seul connect DB par page

//Vérifier si la voiture avec l'ID existe en BDD
verifyCarExist($car);



$errors = [];
// Si le formulaire est validé
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Vérifier les champs du formulaire
    $errors = validateCarForm($errors,$_POST);
    // Si le formulaire n'a pas renvoyé d'erreurs
    if (empty($errors)) {
        // Mettre à jour la voiture et rediriger
        updateCarByID($pdo, $_POST["brand"], $_POST["model"], $_POST["horsePower"], $_POST["image"], $car["id"]);
        header("Location: index.php");
        exit();

    }

}


$title = "Modifier " . $car["model"];
require_once("header.php");

?>

<h1 class="text-primary">Modifier <?php echo $car["brand"] ?> <?php echo $car["model"] ?> </h1>

<img src="images/<?php echo $car["image"] ?>" alt="<?php echo $car["model"] ?>">


<form method="POST" action="update.php?id=<?php echo ($car["id"]) ?>">

    <label for="model">Model</label>
    <input id="model" type="text" name="model" value="<?php echo ($car["model"])  ?>">
    <?php if (isset($errors['model'])): ?>
        <p class="text-danger"><?= $errors['model'] ?></p>
    <?php endif; ?>

    <label for="brand">Brand</label>
    <input type="text" name="brand" value="<?php echo ($car["brand"])  ?>">
    <?php if (isset($errors['brand'])): ?>
        <p class="text-danger"><?= $errors['brand'] ?></p>
    <?php endif; ?>

    <label for="horsePower">HorsePower</label>
    <input id="horsePower" type="number" name="horsePower" value="<?php echo ($car["horsePower"])  ?>">
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