<?php

require "../common/db_connection.php";
require "../backend/db_config.php";

$result = dbConnection();
session_start();
$email = $_SESSION["user"];

?>

<html>
	<head>
		<title>Homepage restaurant</title>
		<link rel="stylesheet" href="../css/styles.css">
		<link rel="icon" type="image/x-icon" href="assets/waiter.ico" />
	</head>
	<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        		<div class="container">
                		<a class="navbar-brand" href="../index.html">Home</a>
            		</div>
			<button class="btn btn-outline-success my-2 my-sm-0" style="margin-right: 50px;" type="button" onclick="window.location.href='../backend/logout.php';">Logout</button>
        	</nav>
	    	<div class="background">
				<h1>Restaurant's homepage</h1>
				<br>Welcome back, <?=$email?></br>
				<br>
				<a href="datiProdotto.php" class="btn btn-primary">Add new product</a>
				<br>
			</div>
        </body>
</html>