<?php

require "../common/functions.php";

session_start();

$dati = array();

$email = $_SESSION["user"];

$ristorante = $_POST["ristorante"];

$riga_ordine=$_POST["riga_ordine"];

$current_date = date ('Y-m-d H:i:s', time());

insertOrdine($cid, $email, $current_date);
foreach($riga_ordine as $index => $r) {
    insertRigaOrdine($cid, $index, $email, $current_date, $ristorante, $r['title'], $r['price'], $r['quantity']);
}

header('location: ../frontend/basket.php');


?>