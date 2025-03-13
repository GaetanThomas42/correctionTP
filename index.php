<?php
$title = "Bienvenue dans le Garage";
require_once("header.php");



require_once("connectDB.php");
$pdo = connectDB();
$requete = $pdo->query("SELECT * FROM car;");
$cars = $requete->fetchAll();
?>


<h1>Listes des Voitures</h1>
<a href="add.php">Add Car</a>
<div class="d-flex flex-wrap">
    <?php foreach ($cars as $car): ?>
        <div class="col-4 d-flex p-3 justify-content-center">
            <img src="images/<?php echo $car["image"] ?>" alt="<?php echo $car["model"] ?>">
            <div class="p-2">
                <h2><?php echo $car["model"] ?></h2>
                <p><?php echo $car["brand"] ?>, <?php echo $car["horsePower"] ?> chevaux</p>
            </div>
            <a class="btn btn-primary" href="update.php?id=<?php echo $car["id"] ?>">Update</a>
            <a class="btn btn-danger" href="delete.php?id=<?php echo $car["id"] ?>">Delete</a>
        </div>
    <?php endforeach; ?>
</div>


<?php
require_once("footer.php");

?>