<?php

require "../common/db_connection.php";
require "db_config.php";

$result = dbConnection();
$cid = $result["value"];
$query = "SELECT email,zona FROM Ristorante;";
$res = $cid->query($query);

if (!$res)
    	 echo "<p>Impossibile eseguire query.</p>"
           . "<p>Codice errore " . $cid->errno
           . ": " . $cid->error . "</p>";
else{
 echo "<table>";
 echo "<tr><th>email</th><th>zona</th></tr>\n";
 while ($row = $res->fetch_row())
 {
    	echo "<tr>";
	echo "<td>$row[0]</td>";
	echo "<td>$row[1]</td>";
	echo "</tr>\n";
 } // fine while
 unset($res); //  istruzione x liberare le risorse allocate
 echo "</table>";
} // fine else

?>