<?php

require "../common/functions.php";
require "../backend/db_config.php";

session_start();
$email = $_SESSION["user"];
$zona=getBuyerZone($cid,$email);
$restaurants=getRestaurantsByZone ($cid,$zona);


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
						<form class="d-flex" role="search">
        					<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        					<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
							<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Order</button>
      					</form>

            		</div>
        	</nav>
	    	<div class="background">
				<h1>Buyer's homepage</h1>
				<br>Welcome back, <?=$email?></br>
				<h4>Restaurants in zona	<?= $zona; ?>:</h4> 
					<div class="container">
					<div class="row">
						<div class="col-md-6 offset-md-3">
						<?php
						foreach ($restaurants as $restaurant) 
						{
						?>
						<div class="card mb-3 bg-dark card-restaurant position-relative">
							<div class="row g-0">
								<div class="col">
									<div class="card-body">
										<a href="listaProdottiRistorante.php?email_ristorante=<?=$restaurant["email"]?>" class="stretched-link">
											<h5 class="card-title">
												<?= $restaurant["r_sociale"]; ?>
											</h5>
										</a>
										<p class="card-text"><?= $restaurant["indirizzo"];?></p>
										<p class="card-text"><small class="text-<?= $restaurant["stato"]=="Chiuso" ? "danger" : "success" ?>"><?=$restaurant["stato"] ?></small></p>
									</div>
								</div>
							</div>
						</div>
						<?php
						}
						?>
						</div>
					</div>
				</div>	
            </div>
				
        </body>

</html>



