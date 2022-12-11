<?php

require "../common/db_connection.php";
require "../backend/db_config.php";

$result = dbConnection();
$email_ristorante=$_GET["email_ristorante"];
session_start();
$cid = $result["value"];
$result = $cid->query("SELECT r_sociale FROM Ristorante WHERE email = '".$email_ristorante."'");
$rows = $result->fetch_row();
$r_sociale=$rows[0];
$result = $cid->query("SELECT nome, tipo, descrizione, prezzo, immagine FROM Prodotto WHERE prodotto.ristorante = '".$email_ristorante."'");

?>
<html>
	<head>
		<title>Login</title>
		<link rel="stylesheet" href="../css/styles.css">
	</head>
	<body>
	    	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        		<div class="container">
                		<a class="navbar-brand" href="../index.html">Home</a>
            		</div>
        	</nav>
	    	<div class="background">
			<h1><?=  $r_sociale; ?> products:</h1>
            <?php
				while($row = $result->fetch_row())
				{
				?>
					<div class="card" style="width: 18rem;">
  					<img src=<?=$row[3]?> class="card-img-top" alt="...">
  					<div class="card-body">
    				<h5 class="card-title"><?=$row[0]?></h5>
    			<p class="card-text"><?=$row[2]?></p>
    					<a href="#" class="btn btn-primary">Aggiungi all'ordine</a>
  </div>
</div>
							<h5></h5>
			<?php
			}
			?>
            </div>
        </body>

</html>