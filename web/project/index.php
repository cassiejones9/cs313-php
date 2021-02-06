<?php
session_start();
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
    <?php

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

    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
        echo $nameErr;
    } else {
        $name = test_input($_POST["name"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $nameErr = "Only letters and white space allowed";
            echo $nameErr
        }
        $_SESSION["name"] = $name;
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
        echo $emailErr;
    } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            echo $emailErr;
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

    <div class="container">
        <img src="../images/logo.jpg" class="logo">
        <h4>Need family or senior pictures done? Reserve a date that works for you!</h4>
        <div class="title">January 2021</div>
        <form method="post" action="">
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
                        <span class="available">Reserve AM</span>
                        <input type="checkbox" name="jan2am" <?php if (isset($_SESSION["jan2am"])){
                            echo "checked";
                        }   ?> value="Jan 2 am"><br>

                        <span name="jan2pm" class="available">Reserve PM</span>
                        <input type="checkbox" name="jan2pm" <?php if (isset($_SESSION["jan2pm"])){
                            echo "checked";
                        }  ?> value="Jan 2 pm">
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
                        <span name="jan9am" class="available">Reserve AM</span>
                        <input type="checkbox" name="jan9am" <?php if (isset($_SESSION["jan9am"])){echo "checked";}  ?> value="Jan 9 am"><br>
                        <span name="jan9pm" class="available">Reserve PM</span>
                        <input type="checkbox" name="jan9pm" <?php if (isset($_SESSION["jan9pm"])){echo "checked";} ?> value="Jan 9 pm">
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
                        <span name="jan16am" class="available">Reserve AM</span>
                        <input type="checkbox" name="jan16am" <?php if (isset($_SESSION["jan16am"])){echo "checked";} ?> value="Jan 16 am"><br>
                        <span name="jan16pm" class="available">Reserve PM</span>
                        <input type="checkbox" name="jan16pm" <?php if (isset($_SESSION["jan16pm"])){echo "checked";} ?> value="Jan 16 pm">
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
                        <span name="jan23am" class="available">Reserve AM</span>
                        <input type="checkbox" name="jan23am" <?php if (isset($_SESSION["jan23am"])){echo "checked";} ?> value="Jan 23 am"><br>
                        <span name="jan23pm" class="available">Reserve PM</span>
                        <input type="checkbox" name="jan23pm" <?php if (isset($_SESSION["jan23pm"])){echo "checked";} ?> value="Jan 23 pm">
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
                        <span name="jan30am" class="available">Reserve AM</span>
                        <input type="checkbox" name="jan30am" <?php if (isset($_SESSION["jan30am"])){echo "checked";} ?> value="Jan 30 am"><br>
                        <span name="jan30pm" class="available">Reserve PM</span>
                        <input type="checkbox" name="jan30pm" <?php if (isset($_SESSION["jan30pm"])){echo "checked";} ?> value="Jan 30 pm"><br>
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
            <p class="fieldform">Name: <input type="text" name="name" value="<?php echo $_SESSION["name"]; ?>">
                <span class="error">* <?php echo $nameErr; ?></span>
            </p>

            <p class="fieldform">E-mail: <input type="text" name="email" value="<?php echo $_SESSION["email"]; ?>">
                <span class="error">* <?php echo $emailErr; ?></span>
            </p>
            <br><br>
            <input class="reserve" type="submit" name="submit" value="Make the Reservation"></input>
        </form>
        <a class="calbutton" href="viewcart.php">View Cart</a>
    </div>
    <!-- <script src="../js/projectjs.js"></script> -->
</body>

</html>