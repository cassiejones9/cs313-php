<?php
if (!isset($_SESSION)) {
    session_start();
}
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
if (isset($_POST["jan2amdelete"])) {
    unset($_SESSION["jan2am"]);
}

if (isset($_POST["jan2pmdelete"])) {
    unset($_SESSION["jan2pm"]);
}

if (isset($_POST["jan9amdelete"])) {
    unset($_SESSION["jan9am"]);
}

if (isset($_POST["jan9pmdelete"])) {
    unset($_SESSION["jan9pm"]);
}

if (isset($_POST["jan16amdelete"])) {
    unset($_SESSION["jan16am"]);
}

if (isset($_POST["jan16pmdelete"])) {
    unset($_SESSION["jan16pm"]);
}

if (isset($_POST["jan23amdelete"])) {
    unset($_SESSION["jan23am"]);
}

if (isset($_POST["jan23pmdelete"])) {
    unset($_SESSION["jan23pm"]);
}

if (isset($_POST["jan30amdelete"])) {
    unset($_SESSION["jan30am"]);
}

if (isset($_POST["jan30pmdelete"])) {
    unset($_SESSION["jan30pm"]);
}

// if (isset($_POST["people"])){
//     $_SESSION["people"] = $_POST["people"];
// }
?>
    <div class="container">
        <img src="../images/logo.jpg" class="logo">
        <div class="viewclientinfo">
            
                Hi <strong><?php echo $_SESSION["firstname"] . " " . $_SESSION["lastname"] ; ?></strong>!<br>
                Does this reservation and information look correct?<br>
                <!-- check if isset first and then echo it -->
                
                <strong>
                    <?php
                    if (isset($_SESSION["jan2am"])) {
                        echo $_SESSION["jan2am"];
                        echo "<form action='' method='post'>
                        <button type='submit' name='jan2amdelete' value='Remove Jan2am'>Remove Jan2 Photoshoot</button>
                    </form><br><br>";
                    }
                    if (isset($_SESSION["jan2pm"])) {
                        echo $_SESSION["jan2pm"];
                        echo "<form action='' method='post'>
                        <button type='submit' name='jan2pmdelete' value='Remove Jan2pm'>Remove Jan2 Photoshoot</button>
                    </form><br><br>";
                    }
                    if (isset($_SESSION["jan9am"])) {
                        echo $_SESSION["jan9am"];
                        echo "<form action='' method='post'>
                        <button type='submit' name='jan9amdelete' value='Remove Jan9am'>Remove Jan9 Photoshoot</button>
                    </form><br><br>";
                    }
                    if (isset($_SESSION["jan9pm"])) {
                        echo $_SESSION["jan9pm"];
                        echo "<form action='' method='post'>
                        <button type='submit' name='jan9pmdelete' value='Remove Jan9pm'>Remove Jan9 Photoshoot</button>
                    </form><br><br>";
                    }
                    if (isset($_SESSION["jan16am"])) {
                        echo $_SESSION["jan16am"];
                        echo "<form action='' method='post'>
                        <button type='submit' name='jan16amdelete' value='Remove Jan16am'>Remove Jan16 Photoshoot</button>
                    </form><br><br>";
                    }
                    if (isset($_SESSION["jan16pm"])) {
                        echo $_SESSION["jan16pm"];
                        echo "<form action='' method='post'>
                        <button type='submit' name='jan16pmdelete' value='Remove Jan16pm'>Remove Jan16 Photoshoot</button>
                    </form><br><br>";
                    }
                    if (isset($_SESSION["jan23am"])) {
                        echo $_SESSION["jan23am"];
                        echo "<form action='' method='post'>
                        <button type='submit' name='jan23amdelete' value='Remove Jan23am'>Remove Jan23 Photoshoot</button>
                    </form><br><br>";
                    }
                    if (isset($_SESSION["jan23pm"])) {
                        echo $_SESSION["jan23pm"];
                        echo "<form action='' method='post'>
                        <button type='submit' name='jan23pmdelete' value='Remove Jan23pm'>Remove Jan23 Photoshoot</button>
                    </form><br><br>";
                    }
                    if (isset($_SESSION["jan30am"])) {
                        echo $_SESSION["jan30am"];
                        echo "<form action='' method='post'>
                        <button type='submit' name='jan30amdelete' value='Remove Jan30am'>Remove Jan30 Photoshoot</button>
                    </form><br><br>";
                    }
                    if (isset($_SESSION["jan30pm"])) {
                        echo $_SESSION["jan30pm"];
                        echo "<form action='' method='post'>
                        <button type='submit' name='jan30pmdelete' value='Remove Jan30pm'>Remove Jan30 Photoshoot</button>
                    </form><br><br>";
                    }
                    ?>
                </strong>
                <br>
                Email: <?php echo $_SESSION["email"] ?><br>
                Phone: <?php echo $_SESSION["phone"] ?><br>
                Number of People Attending Photoshoot:<br>
                <?php echo $_SESSION["people"]?><br>
        </div>
        <a href="confirmation.php" class="calbutton">Confirm Reservation</a>
        <a href="index.php" class="calbutton">Back to Calendar</a>
        <!-- <input class="reserve" type="submit" name="submit" value="Confirm Number of People">
        <input type="hidden" name="action" value="insertpeople">
        </form> -->
        <!-- <a class="calbutton" href="checkout.php">Checkout</a> -->
    </div>
</body>

</html>


