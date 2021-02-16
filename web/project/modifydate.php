<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once ('connection.php');
$db = get_db();

// select statement here, limit 1 store it in the session 

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CSE 341 | Photography Reservation Modification</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/stylesheet.css" media="screen">
    <!-- Line 11 fixes favicon error -->
    <link rel="icon" href="data:;base64,iVBORw0KGgo=">
    <script src="js.js"></script>
</head>

<body>
    <div class="container">
        <img src="../images/logo.jpg" class="logo">
        <h4>Which date works best for you?</h4>
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
                        <input type="checkbox" name="date[]" value="1"><br>

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
                        <label for="date" name="jan9am" class="available">Reserve AM</label>
                        <input type="checkbox" name="date[]" value="3" id="awesome"><br>
                        <label name="jan9pm" class="available">Reserve PM</label>
                        <input type="checkbox" name="date[]" value="4">
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
                        <label for="date" name="jan23am" class="available">Reserve AM</label>
                        <input type="checkbox" name="date[]" value="7"><br>
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
            
            <input class="reserve" type="submit" name="submit" value="Modify Date">
            <input type="hidden" name="action" value="modifydate">
        </form>
        <!-- <button type="button" onclick="awesome()">Fill in form</button> -->
        <!-- <a class="calbutton" href="viewcart.php">View Cart</a> -->
        <!-- <div>
            <form method="POST" action="dbinfo.php">
                <h4>Admin Login</h4>
                <label>Username:</label>
                <input type="text" name="username"><br>
                <label>Password:</label>
                <input type="password" name="pass"><br>
                <input type="submit" name="login" value="Login">
                <input type="hidden" name="action" value="login">
            </form> -->
        <!-- </div><br><br><br> -->
    </div>
</body>

</html>