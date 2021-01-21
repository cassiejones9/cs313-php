
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
    $jan2am = $jan2pm = $jan9am = $jan9pm = "";
    $jan16am = $jan16pm = $jan23am = $jan23pm = "";
    $jan30am = $jan30pm = $name = $email = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $jan2am = ($_POST["jan2am"]);
        $jan2pm = ($_POST["jan2pm"]);
        $jan9am = ($_POST["jan9am"]);
        $jan9pm = ($_POST["jan9pm"]);
        $jan16am = ($_POST["jan16am"]);
        $jan16pm = ($_POST["jan16pm"]);
        $jan23am = ($_POST["jan23am"]);
        $jan23pm = ($_POST["jan23pm"]);
        $jan30am = ($_POST["jan30am"]);
        $jan30pm = ($_POST["jan30pm"]);

        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
        } else {
            $name = test_input($_POST["name"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
                $nameErr = "Only letters and white space allowed";
            }
        }

        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        } else {
            $email = test_input($_POST["email"]);
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            }
        }
    }

    function test_input($data) {
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
        <form method="post" action="viewcart.php">
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
                        <input type="checkbox" name="jan2am" <?php if (isset($jan2am) && $jan2am = "jan2am"); ?> value="Jan 2 am"><br>
                        <span name="jan2pm" class="available">Reserve PM</span>
                        <input type="checkbox" name="jan2pm" <?php if (isset($jan2pm) && $jan2pm = "jan2pm"); ?> value="Jan 2 pm">
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
                        <input type="checkbox" name="jan9am" <?php if (isset($jan9am) && $jan2am = "jan9am"); ?> value="Jan 9 am"><br>
                        <span name="jan9pm" class="available">Reserve PM</span>
                        <input type="checkbox" name="jan9pm" <?php if (isset($jan9pm) && $jan2am = "jan9pm"); ?> value="Jan 9 pm">
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
                        <input type="checkbox" name="jan16am" <?php if (isset($jan16am) && $jan16am = "jan16am"); ?> value="Jan 16 am"><br>
                        <span name="jan16pm" class="available">Reserve PM</span>
                        <input type="checkbox" name="jan16pm" <?php if (isset($jan16pm) && $jan16pm = "jan16pm"); ?> value="Jan 16 pm">
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
                        <input type="checkbox" name="jan23am" <?php if (isset($jan23am) && $jan23am = "jan23am"); ?> value="Jan 23 am"><br>
                        <span name="jan23pm" class="available">Reserve PM</span>
                        <input type="checkbox" name="jan23pm" <?php if (isset($jan23pm) && $jan23pm = "jan23pm"); ?> value="Jan 23 pm">
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
                        <input type="checkbox" name="jan30am" <?php if (isset($jan30am) && $jan30am = "jan30am"); ?> value="Jan 30 am"><br>
                        <span name="jan30pm" class="available">Reserve PM</span>
                        <input type="checkbox" name="jan30pm" <?php if (isset($jan30pm) && $jan30pm = "jan30pm"); ?> value="Jan 30 pm"><br>
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
            <p class="fieldform">Name: <input type="text" name="name" value="<?php echo $name; ?>">
            <span class="error">* <?php echo $nameErr; ?></span></p>
            
            <p class="fieldform">E-mail: <input type="text" name="email" value="<?php echo $email; ?>">
            <span class="error">* <?php echo $emailErr; ?></span></p>
            <br><br>
            <input class="reserve" type="submit" name="submit" value="Make the Reservation"></input>
        </form>
        <div>
        </div>
    </div>
    <!-- <script src="../js/projectjs.js"></script> -->
</body>

</html>