<?php

require "db_connection.php";
require "../backend/db_config.php";

$result = dbConnection();
$cid = $result["value"];

function visualizzaErrore($chiave)
{
    global $errore,$tipoErrore;
    if (isset($errore[$chiave])) echo "<err>" . $tipoErrore[$errore[$chiave]] . "</err>"; 
}

$tipoErrore = array("1" => "invalid email address",
                    "2" => "invalid password",
		            "3" => "invalid name",
		            "4" => "invalid surname",
		            "5" => "invalid address",
                    "6" => "invalid zone",
                    "7" => "invalid card number",
                    "8" => "invalid intercom",
                    "9" => "invalid phone number",
                    "10" => "invalid VAT number",
                    "11" => "invalid activity name");
$errore = array();
$dati = array();

if (isset($_GET["status"]))
{
	if ($_GET["status"] == "ko")
        $errore = unserialize($_GET["errore"]);
	    $dati = unserialize($_GET["dati"]);
        //print_r($dati);
        //print_r($errore);
}
else
{
	$dati["email"] = "";
    $dati["password"] = "";
	$dati["nome"] = "";
    $dati["cognome"] = "";
    $dati["telefono"] = "";
    $dati["zona"] = "";
    $dati["carta"] = "";
    $dati["via"] = "";
    $dati["civico"] = "";
    $dati["cap"] = "";
    $dati["citofono"] = "";
    $dati["istruzioni"] = "";
    $dati["iva"] = "";
    $dati["attività"] = "";
}

function insertAcquirente($cid, $email, $password, $nome, $cognome, $carta, $via, $civico, $cap, $citofono, $istruzioni, $telefono, $zona)
{
	$insert_stmt = "INSERT INTO Acquirente (email, psw, nome, cognome, data_registrazione, carta_credito, via, civico, cap, citofono, istruzioni_consegna, telefono, zona)
                    VALUES ('" .$email. "', '" .$password. "', '" .$nome. "', '" .$cognome. "', DEFAULT(data_registrazione), '" .$carta. "', '" .$via. "', '" .$civico. "', '" .$cap. "', '" .$citofono. "', '" .$istruzioni. "', '" .$telefono. "', '" .$zona. "')";
    if ($cid->query($insert_stmt) == TRUE)
    {
        echo "Registration successful";
    }
    else
    {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

function insertRistorante($cid, $email, $password, $iva, $attività, $zona, $sede, $indirizzo)
{
    $insert_stmt = "INSERT INTO Ristorante (email, psw, p_iva, r_sociale, zona, sede_legale, ind_completo)
                    VALUES ('" .$email. "', '" .$password. "', '" .$iva. "', '" .$attività. "', '" .$zona. "', '" .$sede. "', '" .$indirizzo. "')";
    if ($cid->query($insert_stmt) == TRUE)
    {
        echo "Registration successful";
    }
    else
    {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

function insertFattorino($cid, $email, $password, $nome, $cognome, $zona)
{
    $insert_stmt = "INSERT INTO Fattorino (email, psw, nome, cognome, zona_operata) 
                    VALUES ('" .$email. "', '" .$password. "', '" .$nome. "', '" .$cognome. "', '" .$zona. "')";
    if ($cid->query($insert_stmt) == TRUE)
    {
        echo "Registration successful";
    }
    else
    {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

function getBuyerZone ($cid, $email)
{
    $result = $cid->query("SELECT zona FROM Acquirente WHERE email = '".$email."'");
    $row = $result->fetch_row();
    $zona = $row[0];
    return $zona;
}
function getRestaurantsByZone ($cid,$zona)
{
    $days = [
        'Domenica',
        'Lunedì',
        'Martedì',
        'Mercoledì',
        'Giovedì',
        'Venerdì',
        'Sabato',
    ];
    $now = time();
    $restaurants=[];
    $current_day=$days[idate('w', $now)];
    $current_hour=idate('H', $now);
    $current_minute=idate('i', $now);
    $daySlot = 'Mattina';
    if (($current_hour == 19 && $current_minute >= 30) || ($current_hour >= 19)) {
        $daySlot = 'Sera';
    } else if (($current_hour == 15 && $current_minute >= 30) || ($current_hour >= 15)) {
        $daySlot = 'Pomeriggio';
    }
    $result = $cid->query("select ristorante.r_sociale, ristorante.ind_completo, apertura.ristorante, ristorante.email "
    . "from ristorante left outer join apertura on (ristorante.email=apertura.ristorante "
    . "and apertura.giorno=\"" . $current_day . "\" and apertura.orario=\"" . $daySlot . "\" ) "
    . "WHERE zona = '".$zona."'");
    while($row = $result->fetch_row())
    {
        $restaurant=["r_sociale"=>$row[0],
                    "indirizzo"=>$row[1],
                    "stato"=>$row[2]==null ? "Chiuso" : "Aperto",
                    "email"=>$row[3]];
        array_push($restaurants,$restaurant);
    }
    return $restaurants;
}

?>