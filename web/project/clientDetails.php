<?php
include "../db/dbConnect.php";
$db = get_db();
session_start();

$id = $_SESSION['clientid'];
$sqlString = 'SELECT * FROM client WHERE clientid = :clientid';
$statement = $db->prepare($sqlString);
$statement->bindValue(':clientid', $id, PDO::PARAM_INT);
$statement->execute();
$row = $statement->fetch(PDO::FETCH_ASSOC);
$displayClientInfo .= "$row[firstname] $row[lastname]  Username: $row[username] Password: $row[pass]  Phone: $row[phone]  City: $row[city]"
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
    <img src="../images/logo.jpg" class="logo">
    <h5>Client Data</h5>
    <?php
    if (isset($displayClientInfo)){
        echo $displayClientInfo;
    }
    
    ?>
  </div>
</body>
</html>