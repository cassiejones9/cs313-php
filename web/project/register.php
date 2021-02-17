<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CSE 341 | Photography Registration</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/stylesheet.css" media="screen">
    <!-- Line 11 fixes favicon error -->
    <link rel="icon" href="data:;base64,iVBORw0KGgo=">
    <script src="js.js"></script>
</head>

<body>
    <div class="container">
        <img src="../images/logo.jpg" class="logo">
        <form method="POST" action="insert_new_client.php">
            <h4>Admin Login</h4>
            <label>Username:</label>
            <input type="text" name="username" id="username" required><br><br>
            <label>Password:</label>
            <span class="required">Password requirements:
                <ul>
                    <li>Must contain at least one;
                        <ul class="">
                            <li>upper case letter (A-Z)</li>
                            <li>lower case letter (a-z)</li>
                            <li>special character (! # $ % - _ = +)</li>
                            <li>number (0-9)</li>
                        </ul>
                    <li>Minimum Length = 8 characters</li>
                    <li>No blank spaces</li>
                </ul>
                <input type="password" name="password" id="password" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?!.*[\s])(?=.*[A-Z])(?=.*[a-z]).*$" required><br>
                <input type="submit" name="login" value="Register">
                <input type="hidden" name="action" value="register">
                <?php if (isset($message)) {
                    echo $message;
                }
                if (isset($_SESSION['message'])) {
                    echo $_SESSION['message'];
                } ?>
        </form>
    </div>
</body>

</html>