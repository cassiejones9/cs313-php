<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CSE 341 | Photography Confirm</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css" media="screen">
    <!-- Line 11 fixes favicon error -->
    <link rel="icon" href="data:;base64,iVBORw0KGgo=">
</head>

<body>

Thanks <?php echo $_POST["name"]; ?> for your reservation!<br>
I look forward to a photoshoot with you on:
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


I will reach out to you at <?php echo $_POST["phone"]; ?> and/or 
<?php echo $_POST["email"] ?> should we have any issues with this date.<br>
Thank you for trusting us to take your pictures!


</body>

</html>
