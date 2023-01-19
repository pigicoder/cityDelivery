<?php

require "../common/functions.php";

session_start();
$email = $_SESSION["user"];

if (!isset($_GET))
	header('Location: ../frontend/datiMenu.php?error=input');

$menu = $_GET["menu_name"];
$description = $_GET["menu_description"];
$type = "Menù";
$price = $_GET["menu_price"];

insertProdotto($cid, $email, $menu, $type, $description, $price, $image);

for ($i = 0; $i < $_GET["num_products"]; $i++)
{
    if (isset($_GET[$i])) {
        $product = $_GET[$i];
        addProductToMenu($cid,$email,$product,$menu);
    }
}

header('location: ../frontend/datiMenu.php');

?>