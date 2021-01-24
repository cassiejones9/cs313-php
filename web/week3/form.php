<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CSE 341 | Week 3 Form Results</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css" media="screen">
    <!-- Line 11 fixes favicon error -->
    <link rel="icon" href="data:;base64,iVBORw0KGgo=">
</head>

<body>

    Hi <?php echo $_POST["name"]; ?>!<br>
    Your email is <?php echo $_POST["email"]; ?><br>
    Your major is <?php echo $_POST["major"]; ?><br>
    You wrote "<?php echo $_POST["comment"]; ?>"<br>
    You have visited<br>
    <?php echo $_POST['ckbox1']; ?> &nbsp;
    <?php echo $_POST['ckbox2']; ?> &nbsp;
    <?php echo $_POST['ckbox3']; ?> &nbsp;
    <?php echo $_POST['ckbox4']; ?> &nbsp;
    <?php echo $_POST['ckbox5']; ?> &nbsp;
    <?php echo $_POST['ckbox6']; ?> &nbsp;
    <?php echo $_POST['ckbox7']; ?> &nbsp;
</body>

</html>