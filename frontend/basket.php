<?php
require "../common/db_connection.php";
require "../backend/db_config.php";

$result = dbConnection();
$rigaordine = getLineOrderOpened($cid,$email);
session_start();

foreach ($rigaordine as $CurrentRigaOrdine)
	{
?>
<div class="card mb-3 bg-dark card-ordine position-relative">
    <div class="row g-0">
        <div class="col">
            <div class="card-body">
                <h5 class="card-title">
                    <?= $rigaordine["nome_prodotto"];$rigaordine["prezzo"]; $rigaordine["quantità"]?>
                </h5>
            </div>
        </div>
    </div>
</div>
<?php
	}
?>