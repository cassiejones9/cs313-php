<?php
// require('connection.php');
// $db = get_db();
if (!isset($_SESSION)) {
    session_start();
}
require('connection.php');
$db = get_db();
if (isset($_POST['lastname'])) {
    $datearray = $_POST['date'];
    $_SESSION['people'] = $_POST['people'];
    $lastname = $_POST['lastname'];
}


// var_dump($datearray);
// exit;


if (empty($_POST['firstname'])) {
    $fnameErr = "<p>Name is required</p>";
    header('location: index.php');
    exit;
} else {
    $firstname = test_inputs($_POST['firstname']);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/", $firstname)) {
        $fnameErr = "<p>Only letters and white space allowed</p>";
    }
    $_SESSION['firstname'] = $firstname;
}

if (empty($lastname)) {
    $lnameErr = "<p>Name is required</p>";
    header('location: index.php');
    exit;
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
    header('location: index.php');
    exit;
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
            $statmnt = $db->prepare("UPDATE dates SET clientId = :clientId WHERE dateId = $datevalue");
            $statmnt->bindValue(':clientId', $client_id);
            $statmnt->execute();
        }
        header("Location: viewcart.php");
        exit;
        break;

    case 'updatereservation':
        // $update =
        // function updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId) {
        // $db = phpmotorsConnect();
        // The SQL statement
        $sql = 'UPDATE client SET invMake = :invMake, invModel = :invModel, invDescription = :invDescription, invImage = :invImage, 
    invThumbnail = :invThumbnail, invPrice = :invPrice, invStock = :invStock, invColor = :invColor, classificationId = :classificationId WHERE invId = :invId';
        // Create the prepared statement using the php_motors connection
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
        $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
        $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
        $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
        $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
        $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
        $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
        $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
        $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
        $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
        // Insert the data
        $stmt->execute();
        // Ask how many rows changed as a result of our insert
        $rowsChanged = $stmt->rowCount();
        // Close the database interaction
        $stmt->closeCursor();
        // var_dump($stmt);
        // echo $rowsChanged;
        // exit;
        // Return the indication of success (rows changed)
        return $rowsChanged;
        include 'viewcart.php';
        exit;

    case 'deletesession':
        $fname = $_SESSION["firstname"];
        $lname = $_SESSION["lastname"];
        $clientid = "(SELECT clientId FROM client WHERE lastName = '$lname' AND firstName = '$fname')";
        $query = "DELETE FROM dates WHERE clientId = $clientid";
        error_log($query);
        echo $query;
        exit;
        $stmt = $db->prepare($query);
        $stmt->execute();
        include 'viewcart.php';
        exit;

        // $deleteResult = deleteVehicle($invId);
        // if ($deleteResult) {
        //   $message = "<p>$invMake $invModel was successfully removed.</p>";
        //   $_SESSION['message'] = $message;
        //   header('location: /phpmotors/vehicles/');
        //   exit;
        // } else {
        //   $message = "<p class='highlight'>$invMake $invModel failed to be deleted.</p>";
        //   $_SESSION['message'] = $message;
        //   header('location: /phpmotors/vehicles/');
        //   exit;
        // }
        // break;

}
    


// foreach ($topic_ids as $topic_id) {
// $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
// if ($action == NULL) {
//   $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
// }

// // info just for the client table
// $query = 'INSERT INTO client(lastName, firstName, email) VALUES(:lastName, :firstName, :email)';
// $stmt = $db->prepare($query);
// $stmt->bindValue(':firstname', $_SESSION["firstname"]);
// $stmt->bindValue(':lastName', $_SESSION["lastname"]);
// $stmt->bindValue(':email', $_SESSION["email"]);
// $stmt->execute();
// get the clientid from above
// $client_id = $db->lastInsertId("client_id_seq");
// foreach ($topic_ids as $topic_id) {
// function test() {
//         $stmt = $db->prepare('INSERT INTO session(clientId, sessionDate) VALUES(:clientId, :sessionDate);');
//         $stmt->bindValue(':clientId', $client_id);
//         $stmt->bindValue(':sessionDate', $_SESSION["jan30pm"]);
//         $stmt->execute();
//     }

// }


// header("Location: viewcart.php");
// exit;
// break;

//     case 'insertpeople':
//         if (isset($_POST["people"])){
//             $_SESSION["people"] = $_POST["people"];
//         }
//         $stmt = $db->prepare('INSERT INTO session(numofpeople) VALUES(:numofpeople) WHERE $*$*$*;');
//         $stmt->bindValue(':numbofpeople', $_SESSION["people"]);
//         $stmt->execute();

    
//     include 'checkout.php';
//     exit;
//     break;

//     case 'insertphone':
//         if (empty($_POST["phone"])) {
//             $phoneErr = "A phone number is required";
//         } else {
//             $phone = test_input($_POST["phone"]);
//             $_SESSION["phone"] = $phone;
//         }
        
//         function test_input($data) {
//             $data = trim($data);
//             $data = stripslashes($data);
//             $data = htmlspecialchars($data);
//             return $data;
//         }
//     include 'confirmation.php';
//     exit;
//     break;

//     case 'login':
    
//     include 'dbinfo.php';
//     exit;
//     break;

//     case 'deletesession':
//         $stmt = $db->prepare('DELETE FROM session WHERE sessionDate');
//         $stmt->bindValue(':numbofpeople', $_SESSION["people"]);
//         $stmt->execute();
//     header("Location: viewcart.php");
//     exit;
//     break;


// }

// Questions: How to do tie inserting data into database across pages? Like later when they add the phone number and the number of people in a session? Or should I combine those pages? LINE 113

// What is an easy was to grab those checkboxes and set that data? line 100 with the error

// can the function test_input($data) go outside the switch case statements?

// need to figure out how to delete a reservation from the database if I want to.

// When should I use include and when should I use location?

// session Id - store it in your superglobal $_SESSION[''] = 

// order by DESC gives you the highest id
