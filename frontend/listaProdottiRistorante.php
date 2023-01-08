<!DOCTYPE html>
<?php

/*require "../common/db_connection.php";
require "../backend/db_config.php";*/
require "../common/functions.php";

$result = dbConnection();
$email_ristorante=$_GET["email_ristorante"];
session_start();
$cid = $result["value"];
$result = $cid->query("SELECT r_sociale FROM Ristorante WHERE email = '".$email_ristorante."'");
$rows = $result->fetch_row();
$r_sociale = $rows[0];
$result = $cid->query("SELECT nome, tipo, descrizione, prezzo, immagine FROM Prodotto WHERE Prodotto.ristorante = '".$email_ristorante."'");

?>
<html>

<head>
    <title>Products</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="icon" type="image/x-icon" href="../assets/waiter.ico" />
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <script src="../js/scripts.js" async></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="../index.html">Home</a>
            <button class="btn btn-outline-success my-2 my-sm-0 position-relative" role="button"
                data-bs-toggle="offcanvas" data-bs-target="#miniCartLayer">
                <span
                    class="minicart-count position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger d-none">
                </span>
                <i class="bi bi-basket2-fill"></i>
                <span class="cart-total-price"></span>
            </button>
        </div>
    </nav>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="miniCartLayer">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Cart</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <section class="row-2">
                <form method="POST" action="../backend/createOrder.php">
                    <div class="cart">
                        <div class="cart-header d-flex justify-content-between">
                            <div class="cart-item cart-header cart-column">PRODUCT</div>
                            <div class="cart-price cart-header cart-column">PRICE</div>
                            <div class="cart-quantity cart-header cart-column">QUANTITY</div>
                            <div class="cart-actions cart-column"> </div>
                        </div>
                        <div class="cart-items"></div>
                        <div class="cart-total">
                            <strong class="cart-total-title">Total</strong>
                            <span class="cart-total-price">€0</span>
                        </div>
                        <input type="hidden" name="ristorante" value="<?= $email_ristorante; ?>"/>
                        <button class="btn btn-primary btn-purchase" type="submit">PURCHASE</button>
                    </div>
                </form>
            </section>
        </div>
    </div>
    <div class="background">
        <h1><?=  $r_sociale; ?> products:</h1>
        <section class="row">
            <?php
		    while($row = $result->fetch_row())
		    {
		    ?>
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?=$row[0]?></h5>
                                <p class="card-text" style="text-align: left"><?=$row[2]?></p>
                                <p class="card-price">€<?=$row[3]?></p>
                                <button onclick="showHide('<?php echo $row[0]?>_form')" class="btn btn-primary">Add to
                                    cart</button>
                                <form id="<?php echo $row[0]?>_form" style="visibility: hidden;">Insert quantity:
                                    <input class="card-quantity-input" type="number" name="quantity" value="1"
                                        min="1" />
                                    <button onclick="showHide('<?php echo $row[0]?>_form')"
                                        class="btn btn-primary add-to-cart" type="button">Add</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <img src="data:image/jpg;base64,<?=base64_encode($row[4])?>" class="card-img-top"
                                alt="..."></img>
                        </div>
                    </div>
                </div>
            </div>
            <?php
		    }
	        ?>
        </section>
    </div>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>