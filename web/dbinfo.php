<?php
include "db/dbConnect.php";
$db = get_db();
?>

<!DOCTYPE html>
<html>

<body>
<h2>Database Connection</h2>

<?php 
foreach ($db->query('SELECT username, password FROM note_user') as $row)
{
  echo 'user: ' . $row['username'];
  echo ' password: ' . $row['password'];
  echo '<br/>';
}
?>

</body>

</html>