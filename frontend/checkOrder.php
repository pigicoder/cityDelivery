<?php

require "../common/functions.php";
session_start();
$email = $_SESSION["user"];

if (empty($email))
    header("Location: login.php");
    
$result = dbConnection();
$RestaurantOrder = getLineOrderByStatus($cid,$email, ['In attesa di accettazione', 'In attesa di conferma', 'In consegna']);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Payment</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/payment.css">
    <link rel="icon" type="image/x-icon" href="assets/waiter.ico" />
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="../frontend/homeAcquirente.php">Home</a>
        </div>
    </nav>
    <div class="background">
        <div class="container">
            <?php
            if(empty($RestaurantOrder)) {
                echo "There's no order to display";
            } else {
             
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
                            $prezzo_tot=$CurrentOrder['prezzo_tot'];   
                            $tempistica_consegna=$CurrentOrder['tempistica_consegna'];                    
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
                                                $ora_ordine=$rigaordine['ora_ordine'];
                            }
                            
                            ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <span style="float:left;">Delivery time:
                    <?=(!$tempistica_consegna) ? "Searching for a delivery driver" : "$tempistica_consegna";;?></span>
                <span style="float:right;">Total price: <?=$prezzo_tot?>;</span>
                <span style="float:right;"><?=($CurrentOrder['stato'])?></span>
                <?php
                if(!$tempistica_consegna) { ?>
                <label for="update-button"></label>
                <button class="btn btn-primary update" id="update-button" style="border-radius: 10px;"
                    onclick="window.location.reload(true);">click to refresh</button>
                <?php
                }
                if($CurrentOrder['stato']=='In attesa di conferma'){  ?>
                <div class="modal-footer">
                    <div class="text-end">
                        <a href="../backend/abortOrder.php?ora_ordine=<?=$ora_ordine?>" class="btn btn-danger">Abort
                            Order</a>
                        </button>
                        <a href="../backend/confirmOrder.php?ora_ordine=<?=$ora_ordine?>" class="btn btn-primary">Confirm</a>
                        </button>
                    </div>
                    <?php
    }
}

}

?>
                </div>
            </div>
            <!-- Bootstrap core JS-->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>