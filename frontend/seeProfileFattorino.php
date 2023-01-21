<?php

require "../common/functions.php";

session_start();
$email=$_SESSION["user"] ;

if (empty($email))
    header("Location: login.php");
    
$cid = $result["value"];
$result = $cid->query("SELECT * FROM Fattorino WHERE email = '".$email."'");
$rows = $result->fetch_row();

?>
<!DOCTYPE html>
<html>

<head>
    <title>Runner's profile</title>
    <link href="../css/styles.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="assets/waiter.ico" />
</head>
<body>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        		<div class="container">
                		<a class="navbar-brand" href="homeFattorino.php">Home</a>
            	</div>
        </nav>
        <br>
	    <div class="background">
            <h3>Profile</h3>
		<div class="container" style="display:flex;width:100%;">
    		<form>
            <div style="width:100%;" align="left">
            <h5 class="card-title">Email: <?=$rows[0]?></h5>
            </div>
            <div style="width:100%;" align="left">
            <h5 class="card-title">Nome: <?=$rows[2]?></h5>
            </div>
            <div style="width:100%;" align="left">
            <h5 class="card-title">Cognome: <?=$rows[3]?></h5>
            </div>
            <div style="width:100%;" align="left">
            <h5 class="card-title">Credito: <?=$rows[4]?></h5>
            </div>
            <div style="width:100%;" align="left">
            <h5 class="card-title">Zona operata: <?=$rows[5]?></h5>
            </div>
            </div>
            <br>
            <a href="updateFattorino.php" class="btn btn-primary">Update profile</a>

 </body>

</html>