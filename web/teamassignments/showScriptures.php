<?php
require ('connection.php');
$db = get_db();


$display = "<h1>Scripture Resources</h1>";
$statement = $db->prepare('SELECT id, book, chapter, verse, content FROM scriptures');
$statement->execute();

// go through each scripture
while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
  $display .= "<p><strong>Book: $row[book] Chapter: $row[chapter] Verse: $row[verse]</strong>";
  $display .= " - '$row[content]'";
  $display .= "Topics: ";

  $stmtTopics = $db->prepare('SELECT name FROM topic t' . 'INNER JOIN linking l ON l.topic_id = t.id' . 'WHERE l.scripture_id = :scripture_id');
  $stmtTopics->bindValue(':scripture_id', $row['id']);
  $stmtTopics->execute();
  // go through each topic
  while ($topicrow = $stmtTopics->fetch(PDO::FETCH_ASSOC)){
      echo $topicrow['name'];
  }
  echo "</p>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Scriptures in Database</title>
</head>

<body>
  <?php
    echo $display;
  ?>


  </body>

</html>
