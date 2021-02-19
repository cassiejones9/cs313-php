<?php
if (!$_SESSION['loggedin']){
  header('Location: index.php');}

if (!isset($_SESSION)) {
  session_start();
}

include "../db/dbConnect.php";
$db = get_db();


$id = $_GET['clientid'];
$sqlString = 'SELECT c.lastName, c.firstName, c.phone, c.email, s.clientId, s.numOfPeople, d.date
FROM client c 
JOIN session s ON s.clientId=c.clientId
JOIN dates d ON d.clientId=c.clientId
WHERE c.clientid = :clientid';
$statement = $db->prepare($sqlString);
$statement->bindValue(':clientid', $id, PDO::PARAM_INT);
$statement->execute();
$row = $statement->fetch(PDO::FETCH_ASSOC);
$displayClientInfo = "<div class='clientDetail'><h5>$row[firstname] $row[lastname]</h5><br>";  
$displayClientInfo .= "<strong><p>Session Date:</strong> $row[date] &nbsp &nbsp <strong>Number of People:</strong> $row[numofpeople]</p><br>";
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
    <a href='insert_new_client.php?action=logout'>Log Out</a>
  </div>
</body>
</html>