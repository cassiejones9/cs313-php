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
            <form action="confirmation.php">
                <?php echo $_POST["name"]; ?><br>

                <label for="phone">Enter a phone number:</label><br><br>
                <input type="tel" id="phone" name="phone" placeholder="123-45-678" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" required><br><br>
                <small>(Format: 123-45-678)</small><br><br>

                <a href="viewcart.php" class="calbutton">Return to Cart</a>
                <input class="reserve" type="submit" name="submit" value="Complete Reservation"></input>
            </form>
        
</body>

</html>