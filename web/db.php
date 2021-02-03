<!DOCTYPE html>
<html>

<body>
    <h2>Is This Working?</h2>

    <!-- <?php

            try {
                $dbUrl = getenv('DATABASE_URL');

                $dbOpts = parse_url($dbUrl);

                $dbHost = $dbOpts["host"];
                $dbPort = $dbOpts["port"];
                $dbUser = $dbOpts["user"];
                $dbPassword = $dbOpts["pass"];
                $dbName = ltrim($dbOpts["path"], '/');

                $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $ex) {
                echo 'Error!: ' . $ex->getMessage();
                die();
            }
            ?> -->

    <?php
    try {
        // default Heroku Postgres configuration URL
        // this is a built in function in php to get the value from an enviornment variable
        $dbUrl = getenv('DATABASE_URL');

        //if we are on heroku this will be set otherwise we can check for a local connection
        //heroku takes care of all of this for us
        if (!isset($dbUrl) || empty($dbUrl)) {
            // example localhost configuration URL with 
            // user: "my_username"
            // password: "my_password"
            // database: "my_database"

            // hardcoded for debugging only not for production site
            $dbUrl = "postgres://my_username:my_password@localhost:5432/my_database";
        }

        // Get the various parts of the DB Connection from the URL
        $dbopts = parse_url($dbUrl);

        $dbHost = $dbopts["host"];
        $dbPort = $dbopts["port"];
        $dbUser = $dbopts["user"];
        $dbPassword = $dbopts["pass"];
        $dbName = ltrim($dbopts["path"], '/');

        // Create the PDO connection
        $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

        // this line makes PDO give us an exception when there are problems, and can be very helpful in debugging!
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //Now we can use $db->
        // $statement = $db->prepare('SELECT id, book, chapter, verse, content FROM scripture');
        // $statement->execute();

        // Go through each result
        // while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        //     echo $row['id'];
        // }
    } catch (PDOException $ex) {
        // for debugging only not for production site
        echo "Error connecting to DB. Details: $ex";
        die();
    }

    return $db;

    foreach ($db->query('SELECT username, password FROM note_user') as $row) {
        echo 'user: ' . $row['username'];
        echo ' password: ' . $row['password'];
        echo '<br/>';
    }
    ?>


</body>

</html>