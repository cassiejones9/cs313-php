<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CSE 341 | Photography View Cart</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/stylesheet.css" media="screen">
    <!-- Line 11 fixes favicon error -->
    <link rel="icon" href="data:;base64,iVBORw0KGgo=">
</head>

<body>
    <div class="container">
        <img src="../images/logo.jpg" class="logo">
        <div class="viewclientinfo">
            <form method="post" action="checkout.php">
                Hi <?php echo $_POST["name"]; ?>!<br>
                Does this reservation look correct?<br>
                <?php echo $_POST['jan2am']; ?>
                <?php echo $_POST['jan2pm']; ?> &nbsp;
                <?php echo $_POST['jan9am']; ?> &nbsp;
                <?php echo $_POST['jan9pm']; ?> &nbsp;
                <?php echo $_POST['jan16am']; ?> &nbsp;
                <?php echo $_POST['jan16pm']; ?> &nbsp;
                <?php echo $_POST['jan23am']; ?> &nbsp;
                <?php echo $_POST['jan23pm']; ?> &nbsp;
                <?php echo $_POST['jan30am']; ?> &nbsp;
                <?php echo $_POST['jan30pm']; ?> &nbsp;

                <br>
                Your email is <?php echo $_POST["email"] ?><br>
        </div>
        <a href="index.php" class="calbutton">Back to Calendar</a>
        <input class="reserve" type="submit" name="submit" value="Continue to Checkout"></input>

        </form>
    </div>
</body>

</html>