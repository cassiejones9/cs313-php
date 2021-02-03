<?php
include "../db/dbConnect.php";
$db = get_db();
session_start();

if (isset($_POST['search'])) {
  $searchClient = $_POST['search'];
  $sqlString = 'SELECT clientId, username, pass, lastName, firstName, phone, city FROM client AS c WHERE lastName = :searchClient';
  $statement = $db->prepare($sqlString);
  $statement->bindValue(':searchClient', $searchClient, PDO::PARAM_STR);
  $statement->execute();
  while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    $displaySearch .= "$row[firstName] $row[lastName] $row[phone]";
    $displaySearch .= "<a href=''>Click Here for More Client Info</a>";
    $_SESSION['clientId'] = $row['clientId'];
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>CSE 341 | Photography Project</title>
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/stylesheet.css" media="screen">
  <!-- Line 11 fixes favicon error -->
  <link rel="icon" href="data:;base64,iVBORw0KGgo=">
</head>

<body>
  <div class="container">
    <img src="../images/logo.jpg" class="logo">
    <h2>Database Information</h2>
    <p>Use the form below to query client data.</p>
    <h4>See All Clients</h4>
    <form method="POST" action="">
      <label>See All Clients</label>
      <input type="submit" name="allclients" value="Go">
    </form>
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