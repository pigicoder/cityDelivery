<?php

require "../common/functions.php";

$dati = array();
$errore = array();

$nome = $_POST["nome"];
$descrizzione = $_POST["descrizzione"];
$price =$_POST["price"];
$tipo =$_POST["tipo"];
$imagine =$_POST["imagine"];

if (empty($nome))
{
	$errore["nome"] = "3";            // assegno un numero al tipo di errore
	$dati["nome"] = "";
}
else
{
		$dati["nome"] = $nome;
}
if (empty($tipo))
{
	$errore["tipo"] = "14";
	$dati["tipo"] = "";
}
else
{
	$dati["tipo"] = $tipo;
}
if (empty($descrizzione))
{
	$errore["descrizzione"] = "12";
	$dati["descrizzione"] = "";
}
else
{
	$dati["descrizzione"] = $descrizzione;
}


if (empty($price))
{
	$errore["price"] = "13";
	$dati["price"] = "";
}
else
{
	$dati["price"] = $price;
}

if (empty($imagine))
{
	$errore["imagine"] = "15";
	$dati["imagine"] = "";
}
else
{
	$dati["imagine"] = $imagine;
}

if (count($errore) > 0)
{
	header('location: ../frontend/datiProdotto.php?status=ko&errore=' . serialize($errore). '&dati=' . serialize($dati));
}
else
{
	// ---INSERT QUERY--- //
	
	insertProdotto($cid,$email,$nome,$tipo,$descrizzione,$price,$imagine);
	$_SESSION["user"] = $email;
	header('location: ../frontend/datiProdotto.php?status=ok&dati=' . serialize($dati));
	
}

?>