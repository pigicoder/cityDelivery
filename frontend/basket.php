<?php

require "../common/functions.php";
session_start();
$email = $_SESSION["user"];
$result = dbConnection();
$RestaurantOrder = getLineOrderOpened($cid,$email);

?>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Payment</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="icon" type="image/x-icon" href="assets/waiter.ico" />
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="../index.html">Home</a>
            <a class="navbar-brand" href="seeProfileAcquirente.php">Profile</a>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
            <button onclick="location.href='basket.php'" class="btn btn-outline-success my-2 my-sm-0"
                type="submit">Order</button>
            <button class="btn btn-outline-success my-2 my-sm-0" style="margin-right: 50px;" type="button"
                onclick="window.location.href='../backend/logout.php';">Logout</button>
        </div>
    </nav>
    <div class="background">
        <div class="container">
            <?php
    foreach ($RestaurantOrder as $CurrentOrder)
	{
    ?>
            <div class="card mb-3 bg-dark card-ordine position-relative">
                <div class="row g-0">
                    <div class="col">
                        <div class="card-body text-start">
                            <h5 class="card-title text-center">
                                <?=$CurrentOrder['nome']?>

                            </h5>
                            <div class="row">
                                <div class="col-md-8 offset-md-2">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-borderless">
                                            <thead>
                                                <tr>
                                                    <th>Nome</th>
                                                    <th class="text-center">Quantità</th>
                                                    <th class="text-end">Prezzo</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php                         
                            foreach ($CurrentOrder['rigaordine'] as $rigaordine)
                            {
                            ?>
                                                <tr>
                                                    <td>
                                                        <?=$rigaordine['nome_prodotto']?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?=$rigaordine['quantità']?>
                                                    </td>
                                                    <td class="text-end">€
                                                        <?=$rigaordine['prezzo']?>
                                                    </td>

                                                </tr>
                                                <?php
                            }
                            
                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="text-end">
                                        <button class="btn btn-danger" type="button">Delete Order
                                        </button>
                                        <button class="btn btn-primary dropdown-toggle" type="button"
                                            id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            Buy
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li><a class="dropdown-item" href="#">Pay by credit card</a></li>
                                            <li><a class="dropdown-item" href="#">Pay in cash</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
	}
   
?>
        </div>
    </div>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>