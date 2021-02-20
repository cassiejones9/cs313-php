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

if (isset($firstname)) {
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
function getUsername($username)
{
    $db = get_db();
    $sql = 'SELECT adminId, username, password FROM admin WHERE username = :username';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $userData;
}

function checkPassword($password)
{
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])(?=.*[A-Z])(?=.*[a-z])([^\s]){8,}$/';
    return preg_match($pattern, $password);
}

function checkExistingUser($username)
{
    $db = get_db();
    $sql = 'SELECT username FROM admin WHERE username = :username';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $matchUser = $stmt->fetch(PDO::FETCH_NUM);
    $stmt->closeCursor();
    if (empty($matchUser)) {
        return 0;
        // echo 'Nothing found';
        // exit;
    } else {
        return 1;
        // echo 'Match found';
        // exit;
    }
}

function regUser($username, $password) {
  $db = get_db();
  $sql = 'INSERT INTO admin (username, password)
       VALUES (:username, :password)';
  // Create the prepared statement
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':username', $username, PDO::PARAM_STR);
  $stmt->bindValue(':password', $password, PDO::PARAM_STR);
  $stmt->execute();
  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();
  return $rowsChanged;
};

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

    case 'login':
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        if (empty($username) || empty($password)) {
            $_SESSION['message'] = "<p class='highlight'>Please provide a valid username and password</p>";
            include 'index.php';
            exit;
        }

        $userData = getUsername($username);

        if (!$userData) {
            $message = '<p>Either the username or the password does not match. Try again.</p>';
            include 'index.php';
            exit;
        }

        $hashCheck = password_verify($password, $userData['password']);

        if (!$hashCheck) {
            $message = '<p class="highlight">Please check your password and try again</p>';
            include 'index.php';
            exit;
        }

        // A valid user exists, log them in
        $_SESSION['loggedin'] = TRUE;

        // Remove the password from the array
        // the array_pop function removes the last element from an array
        array_pop($userData);

        // Store the array into the session
        $_SESSION['userData'] = $userData;

        // Send them to the admin view
        header('Location: dbinfo.php');
        exit;
        break;

    case 'logout':
        $_SESSION = array();
        session_destroy();
        header('Location: index.php');
        break;

    case 'registrationpage':
        include 'register.php';
        exit;

    case 'register':
        // Filter and store the data
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $checkPassword = checkPassword($password);

        // Check for existing email
        $existingUser = checkExistingUser($username);

        // Deal with existing email during registration
        if ($existingUser) {
            $message = '<p>The username already exists. Do you wanto to login instead?</p>';
            include 'index.php';
            exit;
        }

        // Check for missing data
        if (empty($username) || empty($checkPassword)
        ) {
            $message = "<p class='highlight'>Please fill in all fields</p>";
            include '../view/registration.php';
            exit;
        }

        // Hash the checked password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Send the data to the model if no errors exist
        $regOutcome = regUser($username, $hashedPassword);

        if ($regOutcome === 1) {
            // setcookie('firstname', $username, strtotime('+1 year'), '/');
            $_SESSION['message'] = "<p>Thanks for registering $username! Please use your email and password to login.</p>";
            header('Location: index.php');
            exit;
        } else {
            $message = "<p class='highlight'>Sorry $username, but the registration failed. Please try again.</p>";
            include 'register.php';
            exit;
        }
        break;

    default:
    include 'index.php';
    exit;
}
