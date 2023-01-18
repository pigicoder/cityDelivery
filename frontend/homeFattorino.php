<?php

require "../common/functions.php";

session_start();
$email = $_SESSION["user"];

if (empty($email))
    header("Location: login.php");

$zona = getRiderZone($cid, $email);
$orders = getPendingOrdersByZone($cid, $zona);

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
            <a class="navbar-brand" href="historyRider.php">History</a>
        </div>
        <button class="btn btn-outline-success my-2 my-sm-0" style="margin-right: 50px;" type="button"
            onclick="window.location.href='../backend/logout.php';">Logout</button>
    </nav>
    <div class="background">
        <h1>Rider's homepage</h1>
        <br>Welcome back, <?= $email ?></br>
        <div class="container" style="float:left; width:50%;">
            <div class="col-md-6 offset-md-3" style="width:75%; margin-right: 15px;">
                <h4>Pending orders in your zone (<?= $zona; ?>):</h4>
                <label for="update-button">click to refresh</label>
                <button class="btn btn-primary update" id="update-button" style="border-radius: 10px;"
                    onclick="updatePendingOrders()">Get orders</button>
                <div id="pending-orders" style="text-align:left">
                </div>
                <err>
                    
                </err>
            </div>
        </div>
        <div class="container" style="float:right; width:50%;">
            <div class="col-md-6 offset-md-3" style="width:75%; margin-left: 15px;">
                <h4>Confirmed orders:</h4>
                <label for="update-button">click to refresh</label>
                <button class="btn btn-primary update" id="update-button" style="border-radius: 10px;"
                    onclick="updateConfirmedOrders()">Get confirmed orders</button>
                <div id="confirmed-orders" style="text-align:left">
                </div>
            </div>

        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="acceptModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Accept Order</h5>
                    <button type="button" class="close" onclick="$('#acceptModal').modal('hide')">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="../backend/acceptOrder.php" id="acceptForm">
                        <div class="form-group">
                            <label for="delivery_timing">Choose a time for your delivery:</label>
                            <input type="time" class="form-control" id="delivery_timing" name="tempistica_consegna" />
                        </div>
                        <input type="hidden" name="acquirente" value="">
                        <input type="hidden" name="ora_ordine" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Accept Order</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<?php
function checkErrorInput()
{
	if (isset($GET["errore"])) { 
    	$error = $_GET["error"];
    	if ($error == "input") {
        	unset($_GET["error"]);
        	$error = "";
        	echo "Select a delivery timing";
		}
    } else {
        echo "";
    }
    unset($_GET["error"]);
}

?>