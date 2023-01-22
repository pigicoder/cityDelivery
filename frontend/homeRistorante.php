<?php

require "../common/db_connection.php";
require "../backend/db_config.php";

$result = dbConnection();
session_start();
$email = $_SESSION["user"];

if (empty($email))
    header("Location: login.php");

?>

<html>

<head>
    <title>Homepage restaurant</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="icon" type="image/x-icon" href="assets/waiter.ico" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="homeRistorante.php">
                <img src="../assets/Logo_1.png" width="50%"></img>
            </a>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="bi bi-person-circle"></i>
                        <span class="align-self-center"><?= $email ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="calendarRestaurant.php">Schedule</a></li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li><a class="dropdown-item" href="seeProfileRistorante.php">My Profile</a></li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li><a class="dropdown-item" href="../backend/logout.php">Logout</a></li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
	</nav>
    <div class="background">
        <h1>Restaurant's homepage</h1>
        <a href="datiProdotto.php" class="btn btn-primary">Add new product</a>
        <a href="vissualiceProdotti.php" class="btn btn-primary">See/Delete products</a>
        <a href="datiMenu.php" class="btn btn-primary">Create Menu</a>
        <br>
    </div>
</body>
<script src="../js/bundlebasket.js"></script>

</html>