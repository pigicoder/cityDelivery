<?php

require "../common/functions.php";

session_start();
$email = $_SESSION["user"];

if (empty($email))
	header("Location: login.php");

?>
<html>

<head>
	<title>Rider's homepage</title>
	<link rel="stylesheet" href="../css/styles.css">
	<link rel="icon" type="image/x-icon" href="../assets/waiter.ico" />
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="../js/scripts.js"></script>
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container">
			<a class="navbar-brand" href="../index.html">Home</a>
			<a class="navbar-brand" href="seeProfileFattorino.php">Profile</a>
			<a class="navbar-brand" href="calendarRider.php">Calendar</a>
		</div>
		<button class="btn btn-outline-success my-2 my-sm-0" style="margin-right: 50px;" type="button"
			onclick="window.location.href='../backend/logout.php';">Logout</button>
	</nav>
	<div class="background">
		<h1 style="margin-top:5%;">Your past orders:</h1>
		<div class="container" style="float:left; width:50%;">
			<div id="past-orders" style="text-align:left">
			</div>
		</div>
	</div>
</body>

</html>