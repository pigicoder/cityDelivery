<?php

require "../common/db_connection.php";
require "../backend/db_config.php";

$result = dbConnection();
session_start();
$email = $_SESSION["user"];

?>

<html>
	<head>
		<title>Login</title>
		<link rel="stylesheet" href="../css/styles.css">
	</head>
	<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        		<div class="container">
                		<a class="navbar-brand" href="../index.html">Home</a>
            		</div>
			<button class="btn btn-outline-success my-2 my-sm-0" style="float:right" type="button" onclick="window.location.href='../backend/logout.php';">Logout</button>
        	</nav>
	    	<div class="background">
				<h1>Restaurant's homepage</h1>
				<br>Welcome back, <?=$email?></br>
			</div>
        </body>

</html>