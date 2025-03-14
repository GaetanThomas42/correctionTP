<?php
require_once("functions.php");
require_once("connectDB.php");
$pdo = connectDB();
$cars = selectAllCars($pdo);


$title = "Bienvenue dans le Garage";
require_once("header.php");
?>
<h1>Listes des Voitures</h1>
<div class="d-flex flex-wrap">
    <?php foreach ($cars as $car): ?>
        <div class="col-4 d-flex p-3 justify-content-center">
            <img src="images/<?php echo $car["image"] ?>" alt="<?php echo $car["model"] ?>">
            <div class="p-2">
                <h2><?php echo $car["model"] ?></h2>
                <p><?php echo $car["brand"] ?>, <?php echo $car["horsePower"] ?> chevaux</p>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?php
require_once("footer.php");
?>