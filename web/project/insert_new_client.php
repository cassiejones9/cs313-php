<?php
// require('connection.php');
// $db = get_db();
if (!isset($_SESSION)) {
    session_start();
}
require_once ('connection.php');
$db = get_db();
if (isset($_POST['lastname'])) {
    $datearray = $_POST['date'];
    $_SESSION['people'] = $_POST['people'];
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
}

if (isset($_POST['datemod'])) {
    $datemodarray = $_POST['datemod'];
}

if (isset($firstname)){
    $fname = test_inputs($firstname);
    if (!preg_match("/^[a-zA-Z-' ]*$/", $fname)) {
        $fnameErr = "<p>Only letters and white space allowed</p>";
    }
    $_SESSION['firstname'] = $fname;
    
}
// check if name only contains letters and whitespace

if (empty($lastname)) {
    $lnameErr = "<p>Name is required</p>";
} else {
    $lname = test_inputs($lastname);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/", $lname)) {
        $lnameErr = "<p>Only letters and white space allowed</p>";
    }
    $_SESSION['lastname'] = $lname;
}

if (empty($_POST['email'])) {
    $emailErr = "<p>Email is required</p>";
    // header('location: index.php');
    // exit;
} else {
    $email = test_inputs($_POST['email']);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "<p>Invalid email format</p>";
    }
    $_SESSION['email'] = $email;
}

if (empty($_POST['phone'])) {
    $phoneErr = "<p>A phone number is required</p>";
} else {
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT);
    $_SESSION['phone'] = $phone;
}

function test_inputs($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}

switch ($action) {

    case 'insertclient':
        // insert into client
        $query = 'INSERT INTO client(lastName, firstName, phone, email) VALUES(:lastName, :firstName, :phone, :email)';
        $stmt = $db->prepare($query);
        $stmt->bindValue(':lastName', $_SESSION["lastname"]);
        $stmt->bindValue(':firstName', $_SESSION["firstname"]);
        $stmt->bindValue(':phone', $_SESSION["phone"]);
        $stmt->bindValue(':email', $_SESSION["email"]);
        $stmt->execute();
        // get the clientid from above and insert session info
        $client_id = $db->lastInsertId("client_clientId_seq");
        $statement = $db->prepare('INSERT INTO session(clientId, numOfPeople) VALUES(:clientId, :numOfPeople);');
        $statement->bindValue(':clientId', $client_id);
        $statement->bindValue(':numOfPeople', $_SESSION["people"]);
        $statement->execute();
        // insert date info into dates table
        foreach ($datearray as $index => $datevalue) {
            $statmnt = $db->prepare("UPDATE dates SET clientId = $client_id WHERE dateId = $datevalue");
            $statmnt->execute();
        }
        header("Location: viewcart.php");
        exit;
        break;

    case 'modifydate':
        $fname = $_SESSION["firstname"];
        $lname = $_SESSION["lastname"];
        $clientid = "(SELECT clientId FROM client WHERE lastName = '$lname' AND firstName = '$fname')";
        foreach ($datemodarray as $index => $datevalue) {
            $sql = "UPDATE dates SET clientId = $clientid WHERE dateId = $datevalue";
            // $statmnt->bindValue(':clientId', $client_id);'
            $statmnt = $db->prepare($sql);
            $statmnt->execute();
        }
        header("Location: viewcart.php");
        exit;
        break;

    case 'deletesession':
        $fname = $_SESSION["firstname"];
        $lname = $_SESSION["lastname"];
        $clientid = "(SELECT clientId FROM client WHERE lastName = '$lname' AND firstName = '$fname')";
        $query = "UPDATE dates SET clientid = NULL WHERE clientId = $clientid";
        // error_log($query);
        // echo $query;
        // exit;
        $stmt = $db->prepare($query);
        $stmt->execute();
        include 'viewcart.php';
        exit;
}
