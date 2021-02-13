<?php
// require('connection.php');
// $db = get_db();
if (!isset($_SESSION)) {
    session_start();
}
require('connection.php');
$db = get_db();
$datearray = $_POST['date'];
$_SESSION['people'] = $_POST['people'];

echo $datearray || "empty";
exit;


if (empty($_POST["firstname"])) {
    $fnameErr = "<p>Name is required</p>";
    header('location: index.php');
    exit;
} else {
    $firstname = test_inputs($_POST["firstname"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/", $firstname)) {
        $fnameErr = "<p>Only letters and white space allowed</p>";
    }
    $_SESSION["firstname"] = $firstname;
}

if (empty($_POST["lastname"])) {
    $lnameErr = "<p>Name is required</p>";
    header('location: index.php');
    exit;
} else {
    $lastname = test_inputs($_POST["lastname"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/", $lastname)) {
        $lnameErr = "<p>Only letters and white space allowed</p>";
    }
    $_SESSION["lastname"] = $lastname;
}

if (empty($_POST["email"])) {
    $emailErr = "<p>Email is required</p>";
    header('location: index.php');
    exit;
} else {
    $email = test_inputs($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "<p>Invalid email format</p>";
    }
    $_SESSION["email"] = $email;
}

if (empty($_POST["phone"])) {
    $phoneErr = "<p>A phone number is required</p>";
} else {
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT);
    $_SESSION["phone"] = $phone;
}

function test_inputs($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// if (isset($_POST["jan2am"])) {
//     $_SESSION["jan2am"] = ($_POST["jan2am"]);
// }
// if (isset($_POST["jan2pm"])) {
//     $_SESSION["jan2pm"] = ($_POST["jan2pm"]);
// }
// if (isset($_POST["jan9am"])) {
//     $_SESSION["jan9am"] = ($_POST["jan9am"]);
// }
// if (isset($_POST["jan9pm"])) {
//     $_SESSION["jan9pm"] = ($_POST["jan9pm"]);
// }
// if (isset($_POST["jan16am"])) {
//     $_SESSION["jan16am"] = ($_POST["jan16am"]);
// }
// if (isset($_POST["jan16pm"])) {
//     $_SESSION["jan16pm"] = ($_POST["jan16pm"]);
// }
// if (isset($_POST["jan23am"])) {
//     $_SESSION["jan23am"] = ($_POST["jan23am"]);
// }
// if (isset($_POST["jan23pm"])) {
//     $_SESSION["jan23pm"] = ($_POST["jan23pm"]);
// }
// if (isset($_POST["jan30am"])) {
//     $_SESSION["jan30am"] = ($_POST["jan30am"]);
// }
// if (isset($_POST["jan30pm"])) {
//     $_SESSION["jan30pm"] = ($_POST["jan30pm"]);
// }


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
        foreach ($datearray as $date) {
            $statmnt = $db->prepare('INSERT INTO dates(date, clientId) VALUES(:date, :clientId);');
            $statmnt->bindValue(':date', $$date);
            $statmnt->bindValue(':clientId', $client_id);
            $statmnt->execute();
        }
        header("Location: viewcart.php");
        exit;
        break;

    case 'updateclient':
        $update =
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

        // $sql = 'DELETE FROM inventory WHERE invId = :invId';
        // Create the prepared statement using the php_motors connection
        // $stmt = $db->prepare($sql);
        // $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
        // Insert the data
        // $stmt->execute();
        // Ask how many rows changed as a result of our insert
        // $rowsChanged = $stmt->rowCount();
        // Close the database interaction
        // $stmt->closeCursor();
        // var_dump($stmt);
        // echo $rowsChanged;
        // exit;
        // Return the indication of success (rows changed)
        // return $rowsChanged;
        // $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
        // $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
        // $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

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
