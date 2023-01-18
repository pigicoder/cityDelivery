<!DOCTYPE html>
<?php

require "../common/functions.php";

session_start();
$email=$_SESSION["user"] ;

if (empty($email))
    header("Location: login.php");

$cid = $result["value"];
$result = $cid->query("SELECT * FROM Ristorante WHERE email = '".$email."'");
$rows = $result->fetch_row();
$ristorante=$rows[0];
$result = $cid->query("SELECT nome, tipo, descrizione, prezzo, immagine FROM Prodotto WHERE Prodotto.ristorante = '".$email."'");

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
          
        </div>
    </nav>

    <div class="background">
    <h4>Products in restaurant	<?= $ristorante; ?>:</h4> 
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
                              <?php  $nome=$row[0];?>
                                <a  href="../backend/deleteProdotto.php?nome=<?=$nome?>" class="btn btn-primary" >Remove</a>
                            
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