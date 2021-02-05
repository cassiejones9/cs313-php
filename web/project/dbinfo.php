<?php
include "../db/dbConnect.php";
$db = get_db();
session_start();

if (isset($_POST['allcs'])) {
  $displayClients = "Current List of Clients";
  $statement1 = $db->prepare('SELECT * FROM client');
  $statement1->execute();
  while ($row = $statement1->fetch(PDO::FETCH_ASSOC)) {
    $displayClients .= "<a href='clientDetails.php' class='btn btn-secondary'><h5>$row[firstname] $row[lastname]</h5></a>";
    
  }
  $_SESSION['clientid'] = $row['clientid'];
}

if (isset($_POST['search'])) {
  $searchClient = $_POST['search'];
  $sqlString = 'SELECT * FROM client WHERE lastName = :searchClient';
  $statement = $db->prepare($sqlString);
  $statement->bindValue(':searchClient', $searchClient, PDO::PARAM_STR);
  $statement->execute();
  while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    $displaySearch = "";
    $displaySearch .= "Name: $row[firstname] $row[lastname]   Phone: $row[phone]";
    $displaySearch .= "<a href='clientDetails.php' class='btn btn-secondary'> Click Here for More Client Info on $row[firstname]</a>";
    $_SESSION['clientid'] = $row['clientid'];
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>CSE 341 | Photography Client Database</title>
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/stylesheet.css" media="screen">
  <!-- Line 11 fixes favicon error -->
  <link rel="icon" href="data:;base64,iVBORw0KGgo=">
</head>

<body>
  <div class="container">
    <img src="../images/logo.jpg" class="logo">
    <h2>Database Information</h2>
    
    <form method="POST" action="">
      <label>See All Clients</label>
      <input type="hidden" name="allcs" value="allclients">
      <input type="submit" name="allclients" value="Go">
    </form>
    <?php
      if (isset($displayClients)) {
        echo $displayClients;
      }
    ?>
    <p>Or use the form below to query clients by last name.</p>
    <form method="POST" action="">
      <label for="search">Enter Client Last Name</label>
      <input type="text" name="search">
      <input type="submit" name="submit" value="Search">
    </form>
    <?php
      if (isset($displaySearch)) {
        echo $displaySearch;
      }
    ?>
  </div>
</body>

</html>