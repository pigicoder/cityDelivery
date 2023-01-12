<!DOCTYPE html>
<?php

/*require "../common/db_connection.php";
require "../backend/db_config.php";*/
require "../common/functions.php";

$result = dbConnection();
session_start();
$email_acquirente = $_SESSION["user"];
$email_ristorante=$_GET["email_ristorante"];
$cid = $result["value"];
$result = $cid->query("SELECT r_sociale FROM Ristorante WHERE email = '".$email_ristorante."'");
$rows = $result->fetch_row();
$r_sociale = $rows[0];
$result = $cid->query("SELECT nome, tipo, descrizione, prezzo, immagine FROM Prodotto WHERE Prodotto.ristorante = '".$email_ristorante."'");
$line_orders_opened = getLineOrderOpened($cid, $email_acquirente);
$restaurant_line_orders_opened = [];
$tot = 0;
if ($line_orders_opened && array_key_exists($email_ristorante, $line_orders_opened)) {
    $restaurant_line_orders_opened = $line_orders_opened[$email_ristorante]['rigaordine'];
    $tot = $line_orders_opened[$email_ristorante]['prezzo_tot'];
}
?>
<html>

<head>
    <title>Products</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="icon" type="image/x-icon" href="../assets/waiter.ico" />
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/minicart.css">
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
                    class="minicart-count position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger <?= count($restaurant_line_orders_opened) == 0 ? 'd-none' : ''?>">
                    <?= count($restaurant_line_orders_opened);  ?>
                </span>
                <i class="bi bi-basket2-fill"></i>
                <span class="cart-total-price"><?=$tot > 0 ? '€'.$tot : ''?></span>
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
                <form method="POST" action="../backend/createOrder.php" class="minicart-form">
                    <div class="cart">
                        <div class="cart-header d-flex justify-content-between">
                            <div class="cart-item cart-header cart-column">PRODUCT</div>
                            <div class="cart-price cart-header cart-column">PRICE</div>
                            <div class="cart-quantity cart-header cart-column">QUANTITY</div>
                            <div class="cart-actions cart-column"> </div>
                        </div>
                        <div class="cart-items">
                            <?php
                                foreach($restaurant_line_orders_opened as $index => $line_order)
                                {
                            ?>
                            <div class="cart-row">
                                <div class="cart-item cart-column">
                                    <span class="cart-item-title"><?= $line_order['nome_prodotto'] ?></span>
                                    <input type="hidden" name="riga_ordine['<?= $line_order['nome_prodotto'] ?>'][title]"
                                        value="<?= $line_order['nome_prodotto'] ?>">
                                </div>
                                <span class="cart-price-el cart-column">€<?= $line_order['prezzo'] ?></span>
                                <input type="hidden" name="riga_ordine['<?= $line_order['nome_prodotto'] ?>'][price]"
                                    value="<?= $line_order['prezzo'] ?>">
                                <div class="cart-quantity cart-column">
                                    <input class="cart-quantity-input" type="number"
                                        name="riga_ordine['<?= $line_order['nome_prodotto'] ?>'][quantity]"
                                        value="<?= $line_order['quantità'] ?>">
                                </div>
                                <div class="cart-action cart-column">
                                    <button class="btn-remove btn btn-danger" type="button">X</button>
                                </div>
                            </div>
                            <?php
                                }
                            ?>
                        </div>
                        <div class="cart-total">
                            <strong class="cart-total-title">Total</strong>
                            <span class="cart-total-price">€<?=$tot ?></span>
                        </div>
                        <input type="hidden" name="ristorante" value="<?= $email_ristorante; ?>" />
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
    <script src="../assets/bundlebasket.js"></script>
</body>

</html>