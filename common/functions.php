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
                    "11" => "invalid activity name",
                    "12" =>"invalid description",
                    "13" =>"invalid price",
                    "14" =>"invalid type",
                    "15" =>"invalid imagine");
$errore = array();
$dati = array();

if (isset($_GET["status"]))
{
	if ($_GET["status"] == "ko")
    {
        $errore = unserialize($_GET["errore"]);
	    $dati = unserialize($_GET["dati"]);
        //print_r($dati);
        //print_r($errore);
    }
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
    $dati["tipo"] = "";
    $dati["descrizione"] = "";
    $dati["prezzo"] = "";
    $dati["immagine"] = "";
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
        echo "Error: " . $insert_stmt . "<br>" . $cid->error;
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
        echo "Error: " . $insert_stmt. "<br>" . $cid->error;
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
        echo "Error: " . $insert_stmt . "<br>" . $cid->error;
    }
}
function insertProdotto($cid, $email, $nome, $tipo, $descrizione, $prezzo, $immagine)
{
    $insert_stmt = "INSERT INTO Prodotto (ristorante, nome, tipo, descrizione, prezzo, immagine)
                    VALUES ('".$email. "','" .$nome. "', '" .$tipo. "', '" .$descrizione. "', '" .$prezzo. "',  '" .$immagine. "')";
    if ($cid->query($insert_stmt) == TRUE)
    {
        echo "Registration successful";
    }
    else
    {
        echo "Error: " . $insert_stmt . "<br>" . $cid->error;
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
    $restaurants = [];
    $current_day = $days[idate('w', $now)];
    $current_hour = idate('H', $now);
    $current_minute = idate('i', $now);
    $current_daySlot = '';
    if (($current_hour == 19 && $current_minute >= 30) || ($current_hour > 19 && $current_hour < 23) || ($current_hour == 23 && $current_minute <= 30)) 
    {
        $current_daySlot = 'Sera';
    }
    else if (($current_hour == 15 && $current_minute >= 30) || ($current_hour > 15 && $current_hour < 19) || ($current_hour == 19 && $current_minute <= 30)) 
    {
        $current_daySlot = 'Pomeriggio';
    }
    else if (($current_hour == 11 && $current_minute >= 30) || ($current_hour > 11 && $current_hour < 15) || ($current_hour == 15 && $current_minute <= 30))
    {
        $current_daySlot = 'Mattina';
    }
    else
    {
        $current_daySlot = 'Notte';
    }
    $result = $cid->query(
        "SELECT Ristorante.r_sociale, Ristorante.ind_completo, Apertura.ristorante, Ristorante.email "
      . "FROM Ristorante LEFT OUTER JOIN Apertura ON (Ristorante.email = Apertura.ristorante "
      . "AND Apertura.giorno = '" . $current_day . "' "
      . "AND Apertura.orario = '" . $current_daySlot . "' ) "
      . "WHERE zona = '" . $zona . "' ");

    while($row = $result->fetch_row())
    {
        $restaurant = ["r_sociale"=>$row[0],
                       "indirizzo"=>$row[1],
                       "stato"=>$row[2]==null ? "Chiuso" : "Aperto",
                       "email"=>$row[3]];
        array_push($restaurants,$restaurant);
    }
    return $restaurants;
}
function updateAcquirente($cid, $email, $nome, $cognome, $carta, $via, $civico, $cap, $citofono, $istruzioni, $telefono, $zona)
{
	$update_stmt = "UPDATE Acquirente SET nome='" .$nome. "', cognome='" .$cognome. "',
    carta_credito= '" .$carta. "',via='" .$via. "',civico='" .$civico. "', cap='" .$cap. "', citofono='" .$citofono. "',
    istruzioni_consegna='" .$istruzioni. "',telefono='" .$telefono. "', zona= '" .$zona. "' WHERE email='" .$email. "'";
    if ($cid->query($update_stmt) == TRUE)
    {
        echo "Update successful";
    }
    else
    {
        echo "Error: " . $update_stmt. "<br>" . $cid->error;
    }
}
function updateRistorante($cid, $email, $iva, $attività, $zona, $sede, $indirizzo)
{
	$update_stmt = "UPDATE Ristorante
    SET    p_iva='" .$iva. "', r_sociale='" .$attività. "', zona='" .$zona. "', sede_legale='" .$sede. "', ind_completo='" .$indirizzo. "'
     WHERE email='" .$email. "'";
    if ($cid->query($update_stmt) == TRUE)
    {
        echo "Update successful";
    }
    else
    {
        echo "Error: " . $update_stmt . "<br>" . $cid->error;
    }
}
function updateFattorino($cid, $email, $nome, $cognome, $zona)
{
	$update_stmt = "UPDATE Fattorino SET nome='" .$nome. "', cognome='" .$cognome. "',
    zona_operata= '" .$zona. "' WHERE email='" .$email. "'";
    if ($cid->query($update_stmt) == TRUE)
    {
        echo "Update successful";
    }
    else
    {
        echo "Error: " . $update_stmt . "<br>" . $cid->error;
    }
}
function insertOrdine($cid,$acquirente, $ora_ordine)
{
	$insert_stmt = $cid->prepare("INSERT INTO Ordine (acquirente, ora_ordine)
                    VALUES (?,?)");
    $insert_stmt->bind_param('ss', $acquirente, $ora_ordine);
    $insert_stmt->execute();
}

function insertRigaOrdine($cid, $n_riga, $acquirente, $ora_ordine, $ristorante, $nome_prodotto, $prezzo, $qnt)
{
	$insert_stmt = $cid->prepare("INSERT INTO RigaOrdine (n_riga, acquirente, ora_ordine, ristorante, nome_prodotto, prezzo, quantità)
                    VALUES (?,?,?,?,?,?,?)");
    $insert_stmt->bind_param('issssdi', $n_riga, $acquirente, $ora_ordine, $ristorante, $nome_prodotto, $prezzo, $qnt);
    $insert_stmt->execute();
}

function getLineOrderOpened($cid,$email)
{
    $result = $cid->query(
        "SELECT Ristorante.r_sociale, Rigaordine.nome_prodotto, Rigaordine.prezzo, Rigaordine.quantità, Rigaordine.ristorante, Ordine.prezzo_tot,Rigaordine.ora_ordine "   
    .   "FROM Rigaordine JOIN Ristorante ON Rigaordine.ristorante = Ristorante.email JOIN Ordine ON Ordine.acquirente=Rigaordine.acquirente and Ordine.ora_ordine=Rigaordine.ora_ordine "
    .   "WHERE Rigaordine.acquirente='".$email."' and Ordine.stato='In composizione' "
    .   "ORDER BY Rigaordine.ora_ordine DESC");
    $RestaurantOrder=[];
    while($row = $result->fetch_row())
    {
        $email_ristorante = $row[4];
        if (!array_key_exists($email_ristorante,$RestaurantOrder)) 
        {
            $RestaurantOrder[$email_ristorante] = [
                'nome'=>$row[0],
                'prezzo_tot'=>$row[5],
                'rigaordine'=>[]
            ];
        }
        $rigaordine = [
            "nome_prodotto" => $row[1],
            "prezzo" => $row[2],
            "quantità" => $row[3],
            "ristorante" => $row[4],
            "ora_ordine" => $row[6]
        ];
        array_push($RestaurantOrder[$email_ristorante]['rigaordine'],$rigaordine);
    }
    return $RestaurantOrder;
}

function deleteProdotto($cid,$email,$nome)
{
    $delete_stmt = "DELETE FROM Prodotto WHERE ristorante='".$email. "' "
                .  "AND nome='" .$nome. "'";
    if ($cid->query($delete_stmt) == TRUE)
    {
        echo "Delete  successful";
    }
    else
    {
        echo "Error: " . $delete_stmt . "<br>" . $conn->error;
    }
}

function payment($cid,$email,$ora_ordine,$stato,$metodo_pagamento)
{
	$update_stmt = "UPDATE Ordine SET stato='In attesa di accettazione' "
    ."AND metodo_pagamento='".$metodo_pagamento."' "
    ."WHERE acquirente='" .$email. "', ora_ordine='" .$ora_ordine. "' ";
    if ($cid->query($update_stmt) == TRUE)
    {
        echo "Order successful";
    }
    else
    {
        echo "Error: " . $update_stmt . "<br>" . $cid->error;
    }
}

function deleteOrdine($cid,$email,$ora_ordine)
{
    $delete_stmt = "DELETE FROM Ordine WHERE acquirente='".$email. "' "
                .  "AND ora_ordine='" .$ora_ordine. "'";
    if ($cid->query($delete_stmt) == TRUE)
    {
        echo "Delete  successful";
    }
    else
    {
        echo "Error: " . $delete_stmt . "<br>" . $cid->error;
    }
}

function deleteOpenOrders($cid,$email_acquirente,$email_ristorante)
{
    $delete_stmt = "DELETE Ordine FROM Ordine join Rigaordine ON Ordine.acquirente=Rigaordine.acquirente "
                .  "AND Rigaordine.ora_ordine=Ordine.ora_ordine "
                .  "WHERE Rigaordine.ristorante='".$email_ristorante."' "
                .  "AND Ordine.acquirente='".$email_acquirente."' ";
    if ($cid->query($delete_stmt) == TRUE)
    {
        echo "Delete  successful";
    }
    else
    {
        echo "Error: " . $delete_stmt . "<br>" . $cid->error;
    }
}
?>