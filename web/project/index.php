<?php
session_start();

require('connection.php');
$db = get_db();

$i = 0;

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
    <script src="js.js"></script>
</head>

<body>
    <?php


    if (empty($_POST['firstname'])) {
        $fnameErr = "<p>Name is required</p>";
    } else {
        $firstname = test_input($_POST['firstname']);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/", $firstname)) {
            $fnameErr = "<p>Only letters and white space allowed</p>";
        }
        $_SESSION['firstname'] = $firstname;
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

    $sql = 'SELECT dateid, date, clientid FROM dates WHERE clientId is NOT NULL ORDER BY dateid';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $dateid = "$results[dateid]";
    $date = "$results[date]";
    $clientid = "$results[clientid]";
    var_dump($results);
    var_dump($results[0]);

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
                        <?php 
                        if ($results[$i]['dateid'] == 1) {
                            echo "<label for='date' class='available'><s>Reserve AM</s></label>";
                            $i++;
                        }
                        else {
                            echo "<label for='date' class='available'>Reserve AM</label>";
                            echo "<input type='checkbox' name='date[]' value='1'><br>";
                        }
                        ?>

                        <label name="jan2pm" class="available">Reserve PM</label>
                        <input type="checkbox" name="date[]" value="2">
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
                    <?php 
                        if ($results[$i]['dateid'] == 3) {
                            echo "<label for='date' class='available'><s>Reserve AM</s></label>";
                            $i++;
                        }
                        else {
                            echo "<label for='date' class='available'>Reserve AM</label>";
                            echo "<input type='checkbox' name='date[]' value='3'><br>";
                        }
                        ?>
                        <?php 
                        if ($results[$i]['dateid'] == 4) {
                            echo "<label for='date' class='available'><s>Reserve PM</s></label>";
                            $i++;
                        }
                        else {
                            echo "<label for='date' class='available'>Reserve PM</label>";
                            echo "<input type='checkbox' name='date[]' value='4'><br>";
                        }
                        ?>

                    
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
                        <input type="checkbox" name="date[]" value="5"><br>
                        <label name="jan16pm" class="available">Reserve PM</label>
                        <input type="checkbox" name="date[]" value="6">
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
                    <?php 
                        if ($results[$i]['dateid'] == 7) {
                            echo "<label for='date' name='jan23am' class='available'><s>Reserve AM</s></label>";
                            $i++;
                        }
                        else {
                            echo "<label for='date' name='jan23am' class='available'>Reserve AM</label>";
                            echo "<input type='checkbox' name='date[]' value='7'><br>";
                        }
                        ?>

                        
            
                        <label name="jan23pm" class="available">Reserve PM</label>
                        <input type="checkbox" name="date[]" value="8">
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
                        <input type="checkbox" name="date[]" value="9"><br>
                        <label name="jan30pm" class="available">Reserve PM</label>
                        <input type="checkbox" name="date[]" value="10"><br>
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
            <p class="fieldform">First Name: <input type="text" name="firstname" id="fname" required>
                <span class="error">* <?php if (isset($fnameErr)) {
                                            echo $fnameErr;
                                        } ?></span>
            </p>

            <p class="fieldform">Last Name: <input type="text" name="lastname" id="lname" required>
                <span class="error">* <?php if (isset($lnameErr)) {
                                            echo $lnameErr;
                                        } ?></span>
            </p>

            <p class="fieldform">E-mail: <input type="text" name="email" id="email" required>
                <span class="error">* <?php if (isset($emailErr)) {
                                            echo $emailErr;
                                        } ?></span>
            </p><br>

            <label for="phone">
                <p class="fieldform">Phone Number:</p>
            </label>
            <input type="tel" name="phone" placeholder="123-456-7890" id="phone" required>

            <span class="error">* <?php if (isset($phoneErr)) {
                                        echo $phoneErr;
                                    } ?></span>
            <br>
            <p class="fieldform">How many people will be at the photoshoot?</p>
            <select id="normal-select-1" placeholder-text="Number of People" name="people">
                <option <?php if (isset($_SESSION['people']) && $_SESSION['people'] == "1") {
                            echo 'selected="selected"';
                        } ?> value="1" class="select-dropdown__list-item">1</option>
                <option <?php if (isset($_SESSION['people']) && $_SESSION['people'] == "2") {
                            echo 'selected="selected"';
                        } ?> value="2" class="select-dropdown__list-item">2</option>
                <option <?php if (isset($_SESSION['people']) && $_SESSION['people'] == "3") {
                            echo 'selected="selected"';
                        } ?> value="3" class="select-dropdown__list-item">3</option>
                <option <?php if (isset($_SESSION['people']) && $_SESSION['people'] == "4") {
                            echo 'selected="selected"';
                        } ?> value="4" class="select-dropdown__list-item">4</option>
                <option <?php if (isset($_SESSION['people']) && $_SESSION['people'] == "5") {
                            echo 'selected="selected"';
                        } ?> value="5" class="select-dropdown__list-item">5</option>
                <option <?php if (isset($_SESSION['people']) && $_SESSION['people'] == "6") {
                            echo 'selected="selected"';
                        } ?> value="6" class="select-dropdown__list-item">6</option>
                <option <?php if (isset($_SESSION['people']) && $_SESSION['people'] == "7") {
                            echo 'selected="selected"';
                        } ?> value="7" class="select-dropdown__list-item">7</option>
                <option <?php if (isset($_SESSION['people']) && $_SESSION['people'] == "8") {
                            echo 'selected="selected"';
                        } ?> value="8" class="select-dropdown__list-item">8</option>
                <option <?php if (isset($_SESSION['people']) && $_SESSION['people'] == "8+") {
                            echo 'selected="selected"';
                        } ?> value="9" class="select-dropdown__list-item">8+</option>
            </select>
            <br>

            <input class="reserve" type="submit" name="submit" value="Make the Reservation">
            <input type="hidden" name="action" value="insertclient">
        </form>
        <button type="button" onclick="awesome()">Fill in form</button>
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