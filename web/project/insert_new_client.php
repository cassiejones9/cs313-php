<?php
require('connection.php');
$db = get_db();
if (!isset($_SESSION)) {
    session_start();
}

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL) {
  $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}

switch ($action) {
// from index.php getting majority of information from client
    case 'majorityinfo':
if (isset($_POST["jan2am"])) {
    $_SESSION["jan2am"] = ($_POST["jan2am"]);
}
if (isset($_POST["jan2pm"])) {
    $_SESSION["jan2pm"] = ($_POST["jan2pm"]);
}
if (isset($_POST["jan9am"])) {
    $_SESSION["jan9am"] = ($_POST["jan9am"]);
}
if (isset($_POST["jan9pm"])) {
    $_SESSION["jan9pm"] = ($_POST["jan9pm"]);
}
if (isset($_POST["jan16am"])) {
    $_SESSION["jan16am"] = ($_POST["jan16am"]);
}
if (isset($_POST["jan16pm"])) {
    $_SESSION["jan16pm"] = ($_POST["jan16pm"]);
}
if (isset($_POST["jan23am"])) {
    $_SESSION["jan23am"] = ($_POST["jan23am"]);
}
if (isset($_POST["jan23pm"])) {
    $_SESSION["jan23pm"] = ($_POST["jan23pm"]);
}
if (isset($_POST["jan30am"])) {
    $_SESSION["jan30am"] = ($_POST["jan30am"]);
}
if (isset($_POST["jan30pm"])) {
    $_SESSION["jan30pm"] = ($_POST["jan30pm"]);
}

if (empty($_POST["firstname"])) {
    $fnameErr = "<p 'style=color:red;'>Name is required</p>";
} else {
    $firstname = test_input($_POST["firstname"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/", $firstname)) {
        $fnameErr = "<p 'style=color:red;'>Only letters and white space allowed</p>";
    }
    $_SESSION["firstname"] = $firstname;
}

if (empty($_POST["lastname"])) {
    $lnameErr = "<p 'style=color:red;'>Name is required</p>";
} else {
    $lastname = test_input($_POST["lastname"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/", $lastname)) {
        $lnameErr = "<p 'style=color:red;'>Only letters and white space allowed</p>";
    }
    $_SESSION["lastname"] = $lastname;
}

if (empty($_POST["email"])) {
    $emailErr = "<p 'style=color:red;'>Email is required</p>";
} else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "<p 'style=color:red;'>Invalid email format</p>";
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

// // info just for the scriptures table
$query = 'INSERT INTO client(lastName, firstName, email) VALUES(:lastName, :firstName, :email)';
$stmt = $db->prepare($query);
$stmt->bindValue(':book', $_SESSION["firstname"]);
$stmt->bindValue(':firstName', $_SESSION["lastname"]);
$stmt->bindValue(':email', $_SESSION["email"]);
$stmt->execute();
// get the scripture_id from above
$client_id = $db->lastInsertId("client_id_seq");
// foreach ($topic_ids as $topic_id) {
$stmt = $db->prepare('INSERT INTO session(clientId, sessionDate) VALUES(:clientId, :sessionDate);');
$stmt->bindValue(':clientId', $client_id);
$stmt->bindValue(':sessionDate', $);
$stmt->execute();
// }


header("Location: viewcart.php");
exit;
break;

    case 'insertpeople':
        if (isset($_POST["people"])){
            $_SESSION["people"] = $_POST["people"];
        }
        $stmt = $db->prepare('INSERT INTO session(numofpeople) VALUES(:numofpeople) WHERE $*$*$*;');
        $stmt->bindValue(':numbofpeople', $_SESSION["people"]);
        $stmt->execute();

    
    include 'checkout.php';
    exit;
    break;

    case 'insertphone':
        if (empty($_POST["phone"])) {
            $phoneErr = "A phone number is required";
        } else {
            $phone = test_input($_POST["phone"]);
            $_SESSION["phone"] = $phone;
        }
        
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    include 'confirmation.php';
    exit;
    break;

    case 'login':
    
    include 'dbinfo.php';
    exit;
    break;

    case 'deletesession':
        $stmt = $db->prepare('DELETE FROM session WHERE sessionDate');
        $stmt->bindValue(':numbofpeople', $_SESSION["people"]);
        $stmt->execute();
    header("Location: viewcart.php");
    exit;
    break;


}

// Questions: How to do tie inserting data into database across pages? Like later when they add the phone number and the number of people in a session? Or should I combine those pages?

// What is an easy was to grab those checkboxes and set that data? line 100 with the error

// can the function test_input($data) go outside the switch case statements?

// need to figure out how to delete a reservation from the database if I want to.

// When should I use include and when should I use location?

