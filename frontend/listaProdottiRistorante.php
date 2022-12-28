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
        <link rel="icon" type="image/x-icon" href="../assets/waiter.ico" />
		<link rel="stylesheet" href="../css/styles.css">
        <script src="../js/scripts.js" async></script>
	</head>
	<body>
	    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        	<div class="container">
        		<a class="navbar-brand" href="../index.html">Home</a>
				<form class="d-flex" role="search">
    				<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
    				<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
				</form>
                <button onclick="location.href='basket.php'" class="btn btn-outline-success my-2 my-sm-0" type="submit">Order</button>
    		</div>
        </nav>
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
                                    <button onclick="showHide('<?php echo $row[0]?>_form')" class="btn btn-primary">Add to cart</button>
                                    <form id="<?php echo $row[0]?>_form" style="visibility: hidden;">Insert quantity: 
                                        <input class="card-quantity-input" type="number" name="quantity" value="1" />
                                        <button onclick="showHide('<?php echo $row[0]?>_form')" class="btn btn-primary add-to-cart" type="button">Add</button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <img src="data:image/jpg;base64,<?=base64_encode($row[4])?>" class="card-img-top" alt="..."></img>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
		    }
	        ?>
            </section>
            <section class="row-2">
                <h2 class="section-header">CART</h2>
                <div class="cart">
                    <div class="cart-header">
                        <span class="cart-item cart-header cart-column">PRODUCT</span>
                        <span class="cart-price cart-header cart-column">PRICE</span>
                        <span class="cart-quantity cart-header cart-column">QUANTITY</span>
                    </div>    
                    <div class="cart-items"></div>
                    <div class="cart-total">
                        <strong class="cart-total-title">Total</strong>
                        <span class="cart-total-price">€0</span>
                    </div>
                    <button class="btn btn-primary btn-purchase" type="button">PURCHASE</button>
                </div>
            </section>
        </div>
	</body>
</html>