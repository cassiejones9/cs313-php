<?php
session_start();

require('connection.php');
$db = get_db();

// select statement here, limit 1 store it in the session 

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CSE 341 | Photography Reservation</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/stylesheet.css" media="screen">
    <!-- Line 11 fixes favicon error -->
    <link rel="icon" href="data:;base64,iVBORw0KGgo=">
</head>

<body>
    <?php
    $stmt = $db->prepare('SELECT date FROM dates');
    $stmt->execute();
    $dates = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $datearray = array();
    foreach ($dates as $date) {
        $dateid = $date["id"];
        $datename = $date["date"];
    if (isset($_POST['date'])) {
        $_SESSION[$datename] = ($_POST['date']);
    }
    }

    if (empty($_POST['firstname'])) {
        $fnameErr = "<p>Name is required</p>";
    } else {
        $firstname = test_input($_POST['firstname']);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/", $firstname)) {
            $fnameErr = "<p>Only letters and white space allowed</p>";
        }
        $_SESSION["firstname"] = $firstname;
    }

    if (empty($_POST["lastname"])) {
        $lnameErr = "<p>Name is required</p>";
    } else {
        $lastname = test_input($_POST['lastname']);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/", $lastname)) {
            $lnameErr = "<p >Only letters and white space allowed</p>";
        }
        $_SESSION['lastname'] = $lastname;
    }

    if (empty($_POST['email'])) {
        $emailErr = "<p>Email is required</p>";
    } else {
        $email = test_input($_POST['email']);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "<p>Invalid email format</p>";
        }
        $_SESSION['email'] = $email;
    }

    if (empty($_POST['phone'])) {
        $phoneErr = "<p>A phone number is required</p>";
    } else {
        $phone = preg_replace('/[^0-9+-]/', '', $_POST['phone']);
        // check if phone is good
        if (!preg_replace(INPUT_POST, $phone, FILTER_SANITIZE_NUMBER_INT)) {
            $phoneErr = "<p>Invalid phone format</p>";
        }
        $_SESSION['phone'] = $phone;
    }

    if (isset($_POST['people'])) {
        $_SESSION['people'] = $_POST['people'];
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    ?>

    <div class="container">
        <img src="../images/logo.jpg" class="logo">
        <h4>Need family or senior pictures done? Reserve a date that works for you!</h4>
        <div class="title">January 2021</div>
        <form method="POST" action="insert_new_client.php">
            <table>
                <tr>
                    <th>Sun</th>
                    <th>Mon</th>
                    <th>Tue</th>
                    <th>Wed</th>
                    <th>Thu</th>
                    <th>Fri</th>
                    <th>Sat</th>
                </tr>
                <tr>
                    <td><span class="date">&nbsp;</span></td>
                    <td><span class="date">&nbsp;</span></td>
                    <td><span class="date">&nbsp;</span></td>
                    <td><span class="date">&nbsp;</span></td>
                    <td><span class="date">&nbsp;</span></td>
                    <td><span class="date">1</span></td>
                    <td><span class="date">2</span><br>
                        <label for="date" class="available">Reserve AM</label>
                        <input type="checkbox" name="date[]" value="Jan 2 am"><br>

                        <label name="jan2pm" class="available">Reserve PM</label>
                        <input type="checkbox" name="date[]" value="Jan 2 pm">
                    </td>
                </tr>
                <tr>
                    <td><span class="date">3</span></td>
                    <td><span class="date">4</span></td>
                    <td><span class="date">5</span></td>
                    <td><span class="date">6</span></td>
                    <td><span class="date">7</span></td>
                    <td><span class="date">8</span></td>
                    <td><span class="date">9</span><br>
                        <label for="date" name="jan9am" class="available">Reserve AM</label>
                        <input type="checkbox" name="date[]" value="Jan 9 am"><br>
                        <label name="jan9pm" class="available">Reserve PM</label>
                        <input type="checkbox" name="date[]" value="Jan 9 pm">
                    </td>
                </tr>
                <tr>
                    <td><span class="date">10</span></td>
                    <td><span class="date">11</span></td>
                    <td><span class="date">12</span></td>
                    <td><span class="date">13</span></td>
                    <td><span class="date">14</span></td>
                    <td><span class="date">15</span></td>
                    <td><span class="date">16</span><br>
                        <label for="date" name="jan16am" class="available">Reserve AM</label>
                        <input type="checkbox" name="date[]" value="Jan 16 am"><br>
                        <label name="jan16pm" class="available">Reserve PM</label>
                        <input type="checkbox" name="date[]" value="Jan 16 pm">
                    </td>
                </tr>
                <tr>
                    <td><span class="date">17</span></td>
                    <td><span class="date">18</span></td>
                    <td><span class="date">19</span></td>
                    <td><span class="date">20</span></td>
                    <td><span class="date">21</span></td>
                    <td><span class="date">22</span></td>
                    <td><span class="date">23</span><br>
                        <label for="date" name="jan23am" class="available">Reserve AM</label>
                        <input type="checkbox" name="date[]" value="Jan 23 am"><br>
                        <label name="jan23pm" class="available">Reserve PM</label>
                        <input type="checkbox" name="date[]" value="Jan 23 pm">
                    </td>
                </tr>
                <tr>
                    <td><span class="date">24</span></td>
                    <td><span class="date">25</span></td>
                    <td><span class="date">26</span></td>
                    <td><span class="date">27</span></td>
                    <td><span class="date">28</span></td>
                    <td><span class="date">29</span></td>
                    <td><span class="date">30</span><br>
                        <label for="date" name="jan30am" class="available">Reserve AM</label>
                        <input type="checkbox" name="date[]" value="Jan 30 am"><br>
                        <label name="jan30pm" class="available">Reserve PM</label>
                        <input type="checkbox" name="date[]" value="Jan 30 pm"><br>
                    </td>
                </tr>
                <tr>
                    <td><span class="date">31</span></td>
                    <td><span class="date">&nbsp;</span></td>
                    <td><span class="date">&nbsp;</span></td>
                    <td><span class="date">&nbsp;</span></td>
                    <td><span class="date">&nbsp;</span></td>
                    <td><span class="date">&nbsp;</span></td>
                    <td><span class="date">&nbsp;</span></td>
                </tr>

            </table>
            <p class="fieldform">First Name: <input type="text" name="firstname" value="<?php echo $_SESSION['firstname']; ?>">
                <span class="error">* <?php echo $fnameErr; ?></span>
            </p>

            <p class="fieldform">Last Name: <input type="text" name="lastname" value="<?php echo $_SESSION['lastname']; ?>">
                <span class="error">* <?php echo $lnameErr; ?></span>
            </p>

            <p class="fieldform">E-mail: <input type="text" name="email" value="<?php echo $_SESSION['email']; ?>">
                <span class="error">* <?php echo $emailErr; ?></span>
            </p><br>

            <label for="phone">
                <p class="fieldform">Phone Number:</p>
            </label>
            <input type="tel" name="phone" placeholder="123-456-7890" value="<?php 
            if (isset($_SESSION['phone'])) {
                echo $_SESSION['phone'];
                } ?>" required>

            <span class="error">* <?php echo $phoneErr; ?></span>
            <?php if (isset($_SESSION['phone'])) {
                echo "*Your number has been saved*";
            } ?><br>
            <p class="fieldform">How many people will be at the photoshoot?</p>
            <select id="normal-select-1" placeholder-text="Number of People" name="people">
                <option <?php if ($_SESSION['people'] == "1") {
                            echo 'selected="selected"';
                        } ?> value="1" class="select-dropdown__list-item">1</option>
                <option <?php if ($_SESSION['people'] == "2") {
                            echo 'selected="selected"';
                        } ?> value="2" class="select-dropdown__list-item">2</option>
                <option <?php if ($_SESSION['people'] == "3") {
                            echo 'selected="selected"';
                        } ?> value="3" class="select-dropdown__list-item">3</option>
                <option <?php if ($_SESSION['people'] == "4") {
                            echo 'selected="selected"';
                        } ?> value="4" class="select-dropdown__list-item">4</option>
                <option <?php if ($_SESSION['people'] == "5") {
                            echo 'selected="selected"';
                        } ?> value="5" class="select-dropdown__list-item">5</option>
                <option <?php if ($_SESSION['people'] == "6") {
                            echo 'selected="selected"';
                        } ?> value="6" class="select-dropdown__list-item">6</option>
                <option <?php if ($_SESSION['people'] == "7") {
                            echo 'selected="selected"';
                        } ?> value="7" class="select-dropdown__list-item">7</option>
                <option <?php if ($_SESSION['people'] == "8") {
                            echo 'selected="selected"';
                        } ?> value="8" class="select-dropdown__list-item">8</option>
                <option <?php if ($_SESSION['people'] == "8+") {
                            echo 'selected="selected"';
                        } ?> value="9" class="select-dropdown__list-item">8+</option>
            </select>
            <br>
            <input class="reserve" type="submit" name="submit" value="Make the Reservation">
            <input type="hidden" name="action" value="insertclient">
        </form>
        <!-- <a class="calbutton" href="viewcart.php">View Cart</a> -->
        <div>
            <form method="POST" action="dbinfo.php">
                <h4>Admin Login</h4>
                <label>Username:</label>
                <input type="text" name="username"><br>
                <label>Password:</label>
                <input type="password" name="pass"><br>
                <input type="submit" name="login" value="Login">
                <input type="hidden" name="action" value="login">
            </form>
        </div><br><br><br>
    </div>
</body>

</html>