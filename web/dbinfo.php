<?php
include "db/dbConnect.php";
$db = get_db();
?>

<!DOCTYPE html>
<html>

<body>
<h2>Database Connection</h2>

<?php 
$statement = $db->query('SELECT username, password FROM note_user');
while ($row = $statement->fetch(PDO::FETCH_ASSOC))
{
  echo 'user: ' . $row['username'] . ' password: ' . $row['password'] . '<br/>';
}

?>

</body>

</html>