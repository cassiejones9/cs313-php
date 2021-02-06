<?php
include "../db/dbConnect.php";
$db = get_db();
session_start();

if (isset($_POST['allcs'])) {
  $displayClients = "<h6>Current List of Clients</h6><br>";
  $statement = $db->prepare('SELECT clientid, username, pass, lastname, firstname, phone, email FROM client');
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
  $sqlString = 'SELECT clientid, username, pass, lastname, firstname, phone, email FROM client WHERE lastname = :searchClient';
  $statement = $db->prepare($sqlString);
  $statement->bindValue(':searchClient', $searchClient, PDO::PARAM_STR);
  $statement->execute();
  while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    $displaySearch = "";
    $displaySearch .= "<h5><strong>Name:</strong> $row[firstname] $row[lastname] &nbsp &nbsp <strong>Phone:</strong> $row[phone]</h5>";
    $displaySearch .= "<a href='clientDetails.php?clientid=$row[clientid]' class='btn btn-secondary'> Click Here for More Client Info on $row[firstname]</a>";
  }
}

// Filter and Validate the Form
$password = $_POST['pass'];
$uppercase = preg_match('@[A-Z]@', $password);
$lowercase = preg_match('@[a-z]@', $password);
$number    = preg_match('@[0-9]@', $password);
$specialChars = preg_match('@[^\w]@', $password);

if (isset($_POST['pass'])) {
  if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
    echo '*Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
  } else {
    echo 'Strong password';
  }
}
if (empty($_POST["username"])) {
  $usernameErr = "*A username is required*";
  echo $usernameErr;
} else {
  $username = test_input($_POST["username"]);
  // check if name only contains letters and whitespace
  if (!preg_match("/^[a-zA-Z-' ]*$/", $username)) {
    $usernameErr = "Only letters and white space allowed";
    echo $usernameErr;
  }
  $_SESSION["name"] = $name;
}

if (empty($_POST["email"])) {
  $emailErr = "Email is required";
} else {
  $email = test_input($_POST["email"]);
  // check if e-mail address is well-formed
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $emailErr = "Invalid email format";
  }
  $_SESSION["email"] = $email;
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

    <form method="POST" action="">
      <label>
        <h4>See All Clients</h4>
      </label>
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
      <label for="search">
        <h4>Enter Client Last Name</h4>
      </label><br>
      <input type="text" name="search">
      <input type="submit" name="submit" value="Search">
    </form>
    <?php
    if (isset($displaySearch)) {
      echo $displaySearch;
    }
    ?>
    <br>
    <br>
    <form method="$_POST" action="">
      <h2>New Patient Form</h2>
      <label>Username</label>
      <input type="text" name="username" value=""><br>
      <label>Password</label>
      <input type="password" name="pass" value=""><br>
      <label>First Name</label>
      <input type="text" name="firstname" value=""><br>
      <label>Last Name</label>
      <input type="text" name="lastname" value=""><br>
      <label>Phone Number</label>
      <input type="tel" name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" value="i.e. 555-555-5555"><br>
      <label>Email</label>
      <input type="email" name="email" value=""><br>
      <input type="submit" name="submit" value="submit">
    </form>
  </div>
</body>

</html>