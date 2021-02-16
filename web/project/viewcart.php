<?php
if (!isset($_SESSION)) {
    session_start();
}
require('connection.php');
$db = get_db();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CSE 341 | View Photography Reservation</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/stylesheet.css" media="screen">
    <!-- Line 11 fixes favicon error -->
    <link rel="icon" href="data:;base64,iVBORw0KGgo=">
</head>

<body>
    <?php

    ?>
    <div class="container">
        <img src="../images/logo.jpg" class="logo">
        <div class="viewclientinfo">

            Hi <strong><?php echo $_SESSION["firstname"] . " " . $_SESSION["lastname"]; ?></strong>!<br>
            Does this reservation and information look correct?<br>
            <strong>
                <?php
                $display = "<h3>Your Reservation</h3>";
                $clientid = "SELECT clientId FROM client WHERE lastName = '$_SESSION[lastname]' AND firstName = '$_SESSION[firstname]'";
                $query = "SELECT date FROM dates WHERE clientid = $clientid";
                $stmt = $db->prepare($query);
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $display .= "<h4>$row[date]</h4>";
                    $display .= "<form method='POST' action='insert_new_client.php'>
                    <input class='reserve' type='submit' name='delete' value='Delete Reservation'>
                    <input type='hidden' name='action' value='deletesession'>
                </form>";
                }
                echo $display;
                ?>
            </strong>
            
            <br>
            Email: <?php echo $_SESSION["email"] ?><br>
            Phone: <?php echo $_SESSION["phone"] ?><br>
            Number of People Attending Photoshoot:<br>
            <?php echo $_SESSION["people"] ?><br>
        </div>
        <form method="POST" action="insert_new_client.php">
            <a href="index.php" class="calbutton">Make Changes to Reservation</a>
            <a href="confirmation.php" class="calbutton">Confirm Reservation</a>
        </form>
        <!-- <a class="calbutton" href="checkout.php">Checkout</a> -->
    </div>
</body>

</html>