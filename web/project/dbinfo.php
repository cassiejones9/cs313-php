<?php
include "../db/dbConnect.php";
$db = get_db();
session_start();

if (isset($_POST['allcs'])) {
  $displayClients = "<h6>Current List of Clients</h6><br>";
  $statement = $db->prepare('SELECT clientid, username, pass, lastname, firstname, phone, email FROM client');
  $statement->execute();
  while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    $displayClients .= "<a href='clientDetails.php' class='btn btn-secondary'><h5>$row[firstname] $row[lastname]</h5></a><br>";
    $_SESSION['clientid'] = $row['clientid'];
  }
}

if (isset($_POST['search'])) {
  $searchClient = $_POST['search'];
  $sqlString = 'SELECT clientid, username, pass, lastname, firstname, phone, email FROM client WHERE lastname = :searchClient';
  $statement = $db->prepare($sqlString);
  $statement->bindValue(':searchClient', $searchClient, PDO::PARAM_STR);
  $statement->execute();
  while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    $displaySearch = "";
    $displaySearch .= "<h5><strong>Name:</strong> $row[firstname] $row[lastname] &nbsp &nbsp <strong>Phone:</strong> $row[phone]</h5>";
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
      <label><h4>See All Clients</h4></label>
      <input type="hidden" name="allcs" value="allclients">
      <input type="submit" name="allclients" value="Go">
    </form>
    <?php
      if (isset($displayClients)) {
        echo $displayClients;
      }
    ?>
    <br>
    <br>
    <p>*Or use the form below to query clients by last name.*</p>
    <form method="POST" action="">
      <label for="search"><h4>Enter Client Last Name</h4></label>
      <input type="text" name="search">
      <input type="submit" name="submit" value="Search">
    </form>
    <?php
      if (isset($displaySearch)) {
        echo $displaySearch;
      }
    ?>
    <form>
      <h2>New Patient Form</h2>
      <label>Username</label>
      <input type="checkbox" name="" value="">
      <input>
    </form>
  </div>
</body>

</html>