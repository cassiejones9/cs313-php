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
    <title>CSE 341 | Confirmed Photoshoot</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/stylesheet.css" media="screen">
    <!-- Line 11 fixes favicon error -->
    <link rel="icon" href="data:;base64,iVBORw0KGgo=">
</head>

<body>
    <div class="container">
        <img src="../images/logo.jpg" class="logo">
        <h4 class="confirmationtext">Thanks <?php echo $_SESSION["firstname"]; ?> for your reservation! The photoshoot is confirmed for</h4><br>
                <?php
                $fname = $_SESSION["firstname"];
                $lname = $_SESSION["lastname"];
                $clientid = "(SELECT clientId FROM client WHERE lastName = '$lname' AND firstName = '$fname')";
                $stmt = $db->prepare($clientid);
                $stmt->execute();
                $query = "SELECT date FROM dates WHERE clientid = $clientid";
                $statment = $db->prepare($query);
                $statment->execute();
                while ($row = $statment->fetch(PDO::FETCH_ASSOC)) {
                    $display = "<h4>$row[date]</h4>";
                }
                echo $display;
                ?>
            </strong>
        </div>
            <br><br>
            <h4>I will reach out to you at <strong><?php echo $_SESSION["phone"]; ?></strong> and/or <strong>
                <?php echo $_SESSION["email"] ?></strong> should we have any issues with this date.<br><br>
            Thank you for trusting us to take your pictures!
        </h4>
        <div>
            <a href="index.php" class="calbutton">Back to Calendar</a>
        </div>
    </div>
</body>

</html>