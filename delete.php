<?php
//Vérifier si l'ID est présent dans l'url
if (empty($_GET["id"])) {
    header("Location: index.php?delete=idMissing");
    exit();
}
//Select by id
//J'appel ma BDD quand j'en ai besoin
require_once("connectDB.php");
$pdo = connectDB();
$requete = $pdo->prepare("SELECT * FROM car WHERE id = :id;");
$requete->execute([
    ":id" => $_GET["id"]
]);
$car = $requete->fetch();
var_dump("Car est un tableau", is_array($car));
var_dump($car);
//Vérifier si la voiture avec l'ID existe en BDD
if ($car == false) {
    header("Location: index.php?delete=IdNotFound");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $requete = $pdo->prepare("DELETE FROM car WHERE id = :id;");
    $requete->execute([
        ":id" => $car["id"]
    ]);
    header("Location: index.php?delete=ok");
}

$title = "Supprimer " . $car["model"];

require_once("header.php");
?>

<h1>Confirmer la suppression de <?php echo $car["brand"] ?> <?php echo $car["model"] ?> ?</h1>

<form class="p-3" method="POST" action="delete.php?id=<?= $car["id"]; ?>">
    <input class="btn btn-outline-primary me-3" type="submit" value="Annuler" formaction="index.php">
    <input class="btn btn-outline-danger" type="submit" value="Confirmer">
</form>


<?php
require_once("footer.php");
?>