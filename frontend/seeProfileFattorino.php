<!DOCTYPE html>
<?php


require "../common/functions.php";

$result = dbConnection();
session_start();
$email=$_SESSION["user"] ;
$cid = $result["value"];
$result = $cid->query("SELECT * FROM Fattorino WHERE email = '".$email."'");
$rows = $result->fetch_row();

?>
<html>

<head>
    <title>Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="icon" type="image/x-icon" href="../assets/waiter.ico" />
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="../index.html">Home</a>
            <section class="row">
</nav>
            <div class="background">
            <h1>Profile</h1>
            <div class="container">
           
            <h5 class="card-title">Email: <?=$rows[0]?></h5>
            <h5 class="card-title">Nome: <?=$rows[2]?></h5>
            <h5 class="card-title">Cognome: <?=$rows[3]?></h5>
            <h5 class="card-title">Credito: <?=$rows[4]?></h5>
            <h5 class="card-title">Zona operata: <?=$rows[5]?></h5>
                                       
                              
                            </div>
                        </div>
                     <!-- UPDATE ISNT DONE!!!!--> 
            <a href="datiProdotto.php" class="btn btn-primary">Update profile</a>
        </section>
    
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>