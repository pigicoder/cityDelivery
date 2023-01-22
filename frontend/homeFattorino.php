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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/scripts.js" async></script>
    <script src="../js/bundlebasket.js"></script>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="homeFattorino.php">
                <img src="../assets/Logo_1.png" width="50%"></img>
            </a>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="bi bi-person-circle"></i>
                        <span class="align-self-center">
                            <?= $email ?>
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="calendarRider.php">Schedule</a></li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li><a class="dropdown-item" href="historyRider.php">History</a></li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li><a class="dropdown-item" href="seeProfileFattorino.php">My Profile</a></li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li><a class="dropdown-item" href="../backend/logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <div class="background">
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
                <h4>Confirmed order:</h4>
                <label for="update-button">click to refresh</label>
                <button class="btn btn-primary update" id="update-button" style="border-radius: 10px;"
                    onclick="updateConfirmedOrders()">Get confirmed order</button>
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