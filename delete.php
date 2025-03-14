<?php
require_once("functions.php");
require_once("connectDB.php");
// Vérifier que l'utilisateur est connécté avec la présence
verifySession();
//Vérifier si l'ID est présent dans l'url
verifyURLID( $_GET["id"]);

//Select by id
$pdo = connectDB(); // Un seul connect DB par page

$car = selectCarByID($pdo, $_GET["id"]);
//Vérifier si la voiture avec l'ID existe en BDD
verifyCarExist($car);


//Si le form est validé
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Supprimer la voiture et rediriger
    deleteCarByID($pdo, $car["id"]);
    header("Location: index.php?delete=ok");
}

$title = "Supprimer " . $car["model"];
require_once("header.php");
?>

<h1>Confirmer la suppression de <?php echo $car["brand"] ?> <?php echo $car["model"] ?> ?</h1>

<form class="p-3" method="POST" action="delete.php?id=<?= $car["id"]; ?>">
    <!-- Redirection admin -->
    <input class="btn btn-outline-primary me-3" type="submit" value="Annuler" formaction="admin.php">
    <!-- Redirection index -->
    <input class="btn btn-outline-danger" type="submit" value="Confirmer">
</form>


<?php
require_once("footer.php");
?>