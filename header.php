<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>
        <?php
        //Si title est défini je l'affiche 
        //Sinon j'affiche "Garage ..."
        echo ($title ?? "Garage Firminul");
        ?>
    </title>
</head>

<body>
    <div class="mb-5 p-3 bg-dark d-flex justify-content-space-evenly text-center" id="navbarNav">

        <a class="col btn text-light" href="index.php">Index</a>

        <div class="d-flex justify-content-evenly col-8">
            <?php
            
            if (!isset($_SESSION)) {
                session_start();
            }

            //Si déconnecté on affiche le lien login
            if (!isset($_SESSION["username"])) { ?>
                <a class="col btn text-light" href="login.php">Login</a>
            <?php
                //Sinon le lien admin et logout 
            } else { ?>
                <a class="col btn text-light" href="admin.php">Admin</a>
                <a class="col btn text-light" href="logout.php">Logout</a>
            <?php
            } ?>
        </div>

    </div>