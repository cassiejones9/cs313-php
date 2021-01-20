<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CSE 341 | Week 3</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css" media="screen">
    <!-- Line 11 fixes favicon error -->
    <link rel="icon" href="data:;base64,iVBORw0KGgo=">
</head>

<body>
    <?php
    // define variables and set to empty values
    $nameErr = $emailErr = $majorErr = "";
    $name = $email = $major = $comment = "";
    $ckbx1 = $ckbx2 = $ckbx3 = $ckbx4 = "";
    $ckbx5 = $ckbx6 = $ckbx7 = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

        if (empty($_POST["comment"])) {
            $comment = "";
        } else {
            $comment = test_input($_POST["comment"]);
        }

        if (empty($_POST["major"])) {
            $majorErr = "Major is required";
        } else {
            $major = test_input($_POST["major"]);
        }
        
        if (empty($_POST["ckbox1"])) {
            $ckbox1 = "";
        } else {
            $ckbox1 = test_input($_POST["ckbox1"]);
        }
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>

    <form method="post" action="form.php">
        Name: <input type="text" name="name" value="<?php echo $name; ?>">
        <span class="error">* <?php echo $nameErr; ?></span>
        <br><br>
        E-mail: <input type="text" name="email" value="<?php echo $email; ?>">
        <span class="error">* <?php echo $emailErr; ?></span>
        <br><br>        
        Major:
        <input type="radio" name="major" <?php if (isset($major) && $major == "Computer Science") echo "checked"; ?> value="Computer Science">Computer Science
        <input type="radio" name="major" <?php if (isset($major) && $major == "Web Design and Development") echo "checked"; ?> value="Web Design and Development">Web Design and Development
        <input type="radio" name="major" <?php if (isset($major) && $major == "Computer Information Technology") echo "checked"; ?> value="Computer Information Technology">Computer Information Technology
        <input type="radio" name="major" <?php if (isset($major) && $major == "Computer Engineering") echo "checked"; ?> value="Computer Engineering">Computer Engineering
        <br><br>
        Comment: <textarea name="comment" rows="2" cols="40"><?php echo $comment; ?></textarea>
        <br><br>
        Which continents have you visited?<br>
        <input type="checkbox" name="ckbox1" <?php if( isset($ckbox1) && $ckbx1 = "North America") echo "checked"; ?> value="North America"> North America<br>
        <input type="checkbox" name="ckbox2" <?php if( isset($ckbox2) && $ckbx2 = "South America") echo "checked"; ?> value="South America"> South America<br>
        <input type="checkbox" name="ckbox3" <?php if( isset($ckbox3) && $ckbx4 = "Europe") echo "checked"; ?> value="Europe"> Europe<br>
        <input type="checkbox" name="ckbox4" <?php if( isset($ckbox4) && $ckbx4 = "Asia") echo "checked"; ?> value="Asia"> Asia<br>
        <input type="checkbox" name="ckbox5" <?php if( isset($ckbox5) && $ckbx5 = "Australia") echo "checked"; ?> value="Australia"> Australia<br>
        <input type="checkbox" name="ckbox6" <?php if( isset($ckbox6) && $ckbx6 = "Africa") echo "checked"; ?> value="Africa"> Africa<br>
        <input type="checkbox" name="ckbox7" <?php if( isset($ckbox7) && $ckbx7 = "Antarctica") echo "checked"; ?>  value="Antarctica"> Antarctica<br>

        <input type="submit" name="submit" value="Submit">
    </form>


</body>

</html>