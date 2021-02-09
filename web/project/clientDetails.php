<?php
include "../db/dbConnect.php";
$db = get_db();


$id = $_GET['clientid'];
$sqlString = 'SELECT * FROM client WHERE clientid = :clientid';
$statement = $db->prepare($sqlString);
$statement->bindValue(':clientid', $id, PDO::PARAM_INT);
$statement->execute();
$row = $statement->fetch(PDO::FETCH_ASSOC);
$displayClientInfo = "<div class='clientDetail'><h5>$row[firstname] $row[lastname]</h5><br>";  
$displayClientInfo .= "<strong><p>Username:</strong> $row[username] &nbsp &nbsp <strong>Password:</strong> $row[pass]</p><br>";
$displayClientInfo .= "<strong><p>Phone:</strong> $row[phone] &nbsp &nbsp <strong>Email:</strong> $row[email]</p></div>";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>CSE 341 | Photography Client Details</title>
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/stylesheet.css" media="screen">
  <!-- Line 11 fixes favicon error -->
  <link rel="icon" href="data:;base64,iVBORw0KGgo=">
</head>

<body>
  <div class="container">
    <img src="../images/logo.jpg" class="logo"><br>
    <h2>Client Data</h2>
    <a href="dbinfo.php" class="btn btn-secondary">Back to Database Home Page</a><br>
    <div class="center">
    <?php
    if (isset($displayClientInfo)){
        echo $displayClientInfo;
    }
    ?>
    </div>
  </div>
</body>
</html>