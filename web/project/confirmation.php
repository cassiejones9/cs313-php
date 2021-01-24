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
    <title>CSE 341 | Photography Confirm</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/stylesheet.css" media="screen">
    <!-- Line 11 fixes favicon error -->
    <link rel="icon" href="data:;base64,iVBORw0KGgo=">
</head>

<body>
<div class="container">
        <img src="../images/logo.jpg" class="logo">
<h4 class="confirmationtext">Thanks <?php echo $_SESSION["name"]; ?> for your reservation for 
<strong><?php
if (isset($_SESSION["people"])){
    echo $_SESSION["people"];
}
?> people!</strong><br><br>
I look forward to a photoshoot with you on:
    <strong>
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
        </strong>
<br><br>
I will reach out to you at <strong><?php echo $_SESSION["phone"]; ?></strong> and/or <strong>
<?php echo $_SESSION["email"] ?></strong> should we have any issues with this date.<br><br>
Thank you for trusting us to take your pictures!
</h4>
</div>
</body>
</html>