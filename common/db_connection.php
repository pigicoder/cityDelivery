<?php

function dbConnection()
{
    global $hostname,$username,$password,$db;
    $res = array("status"=>"ok", "value"=>null);
    $cid = new mysqli($hostname,$username,$password,$db);  
    if ($cid)
    {
        $res["value"] = $cid; 
    }
    else
    {
        $res["status"] = "ko"; 
        $res["value"] = $cid; 
    } 
    return $res;     
}

/*
$cid = new mysqli($hostname,$username,$password,$db);
if($cid->connect_errno)
{
        echo 'Errore connessione (' . $cid->connect_errno . ')' . $cid->connect_error;
}
else
{
        echo 'Connesso. ' . $cid->host_info . "\n";
}
*/

?>