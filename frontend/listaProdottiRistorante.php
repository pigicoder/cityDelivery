<?php

require "../common/db_connection.php";
require "../backend/db_config.php";

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
        <link rel="icon" type="image/x-icon" href="assets/waiter.ico" />
		<link rel="stylesheet" href="../css/styles.css">
	</head>
	<body>
	    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        	<div class="container">
        		<a class="navbar-brand" href="../index.html">Home</a>
				<form class="d-flex" role="search">
    				<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
    				<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
					<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Order</button>
				</form>
                <button onclick="location.href='basket.php'" class="btn btn-outline-success my-2 my-sm-0" type="submit">Order</button>
    		</div>
        </nav>
		<div class="background container">
            <h1><?=  $r_sociale; ?> products:</h1>
            <div class="row">
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
                                    <p class="card-text"><?=$row[2]?></p>
                                    <a href="#" class="btn btn-primary">Aggiungi all'ordine</a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <img src="data:image/jpg;base64,<?=base64_encode($row[4])?>" class=card-img-top alt="..."></img>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
		        }
		        ?>
            </div>
        </div>
	</body>
</html>