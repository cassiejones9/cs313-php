<?php
include "../db/dbConnect.php";
$db = get_db();
// if (!$_SESSION['loggedin']){
//   header('Location: index.php');}

if (!isset($_SESSION)) {
  session_start();
}

if (isset($_POST['allcs'])) {
  $displayClients = "<h3>Current List of Clients</h3><br>";
  $statement = $db->prepare('SELECT c.lastName, c.firstName, c.email, s.clientId, s.numOfPeople, d.date
  FROM client c 
  JOIN session s ON s.clientId=c.clientId
  JOIN dates d ON d.clientId=c.clientId;');
  $statement->execute();
  while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    $displayClients .= "<a href='clientDetails.php?clientid=$row[clientid]' class='btn btn-secondary'><h5>$row[firstname] $row[lastname]</h5></a><br>";
  }
}

if (isset($_POST['search'])) {
  $searchClientName = $_POST['search'];
  $search = strtolower($searchClientName);
  $searchClients = ucfirst($search);
  $searchClient = test_input(($searchClients));
  $sqlString = 'SELECT clientid, lastname, firstname, phone, email FROM client WHERE lastname = :searchClient';
  $statement = $db->prepare($sqlString);
  $statement->bindValue(':searchClient', $searchClient, PDO::PARAM_STR);
  $statement->execute();
  while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    $displaySearch = "";
    $displaySearch .= "<h5><strong>Name:</strong> $row[firstname] $row[lastname] &nbsp &nbsp <strong>Phone:</strong> $row[phone]</h5>";
    $displaySearch .= "<a href='clientDetails.php?clientid=$row[clientid]' class='btn btn-secondary'> Click Here for More Client Info on $row[firstname]</a>";
  }
}

function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
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
  <h3>Welcome <?php $_SESSION['userData']['username']?>! You are logged in.</h3>
    <form method="POST" action="">
      <label>
        <h4>See All Clients</h4>
      </label>
      <input type="hidden" name="allcs" value="allclients">
      <input type="submit" name="allclients" value="Go">
    </form><br>
    <?php
    if (isset($displayClients)) {
      echo $displayClients;
    }
    ?>
    <br>
    <br>
    <p>*Or use the form below to query clients by last name.*</p>
    <form method="POST" action="">
      <label for="search">
        <h4>Enter Client Last Name</h4>
      </label><br>
      <input type="text" name="search">
      <input type="submit" name="submit" value="Search">
    </form><br>
    <?php
    if (isset($displaySearch)) {
      echo $displaySearch;
    }
    ?>
    <br>
    <br>
  <a href='insert_new_client.php?action=logout'>Log Out</a>
  </div>
</body>

</html>
