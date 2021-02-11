<?php
if (!isset($_SESSION)){
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CSE 341 | Photography Checkout</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/stylesheet.css" media="screen">
    <!-- Line 11 fixes favicon error -->
    <link rel="icon" href="data:;base64,iVBORw0KGgo=">
</head>

<body>

    <div class="container">
        <img src="../images/logo.jpg" class="logo">
        <div class="viewclientinfo">
            <form action="insert_new_client.php" method="post">
                <label for="phone">What's your phone number <?php echo $_SESSION["name"] ?>? 
            </label><br><br>
                <input type="tel" id="phone" name="phone" placeholder="123-45-678" value="<?php echo $_SESSION["phone"];?>" required><span class="error"> *<?php echo $phoneErr; ?></span><br><br>
                <small>(Format: 123-45-678)</small><br><br>
                <?php if (isset($_SESSION["phone"])){echo "*Your number has been saved*";} ?><br>
                
                Your photo session of <?php echo $_SESSION["people"]?> people is set for:
                <?php 
        if (isset($_SESSION["jan2am"])){
            echo $_SESSION["jan2am"];
        }
        if (isset($_SESSION["jan2pm"])){
            echo $_SESSION["jan2pm"];
        }
        if (isset($_SESSION["jan9am"])){
            echo $_SESSION["jan9am"];
        }
        if (isset($_SESSION["jan9pm"])){
            echo $_SESSION["jan9pm"];
        }
        if (isset($_SESSION["jan16am"])){
            echo $_SESSION["jan16am"];
        }
        if (isset($_SESSION["jan16pm"])){
            echo $_SESSION["jan16pm"];
        }
        if (isset($_SESSION["jan23am"])){
            echo $_SESSION["jan23am"];
        }
        if (isset($_SESSION["jan23pm"])){
            echo $_SESSION["jan23pm"];
        }
        if (isset($_SESSION["jan30am"])){
            echo $_SESSION["jan30am"];
        }
        if (isset($_SESSION["jan30pm"])){
            echo $_SESSION["jan30pm"];
        }
        ?>
        <br><br>
                <a href="viewcart.php" class="calbutton">Return to Cart</a>
                <input class="reserve" type="submit" name="submit" value="Save Phone Number">
                <input type="hidden" name="action" value="insertphone">
                <!-- <a href="confirmation.php" class="finalcheckoutbutton">Complete Reservation</a> -->
            </form>
        </div>
        
</body>

</html>