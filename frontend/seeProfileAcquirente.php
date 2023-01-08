
<?php


require "../common/functions.php";

$result = dbConnection();
session_start();
$email=$_SESSION["user"] ;
$cid = $result["value"];
$result = $cid->query("SELECT * FROM Acquirente WHERE email = '".$email."'");
$rows = $result->fetch_row();

?>
<!DOCTYPE html>
<html>

<head>
    <title>Buyer's profile</title>
    <link href="../css/styles.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="assets/waiter.ico" />
</head>
<body>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        		<div class="container">
                		<a class="navbar-brand" href="../index.html">Home</a>
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
            <h5 class="card-title">Carta di credito: <?=$rows[5]?></h5>
            </div>
            <div style="width:100%;" align="left">
            <h5 class="card-title">Via: <?=$rows[6]?></h5>
          </div>
          <div style="width:100%;" align="left">
          <h5 class="card-title">Civico: <?=$rows[7]?></h5>
          </div>
          <div style="width:100%;" align="left">
          <h5 class="card-title">Cap: <?=$rows[8]?></h5>
          </div>
          <div style="width:100%;" align="left">
          <h5 class="card-title">Citofono: <?=$rows[9]?></h5>
          </div>
          <div style="width:100%;" align="left">
          <h5 class="card-title">Instruzioni di consegna: <?=$rows[10]?></h5> 
          </div>
          <div style="width:100%;" align="left">
          <h5 class="card-title">Telefono: <?=$rows[11]?></h5> 
          </div>
          <div style="width:100%;" align="left">
          <h5 class="card-title">Zona: <?=$rows[12]?></h5>  
          </div>     
            </div>
            <br>
               
            <a href="updateAcquirente.php" class="btn btn-primary">Update profile</a>
       
</body>

</html>