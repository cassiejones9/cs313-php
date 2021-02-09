<?php
require ('connection.php');
$db = get_db();


$display = "<h1>Scripture Resources</h1>";
$statement = $db->prepare('SELECT id, book, chapter, verse, content FROM scriptures');
$statement->execute();

while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
  $display .= "<p><strong>Book: $row[book] Chapter: $row[chapter] Verse: $row[verse]</strong>";
  $display .= " - '$row[content]'</p>";
}

if (isset($_POST['search'])) {
  $searchBook = $_POST['search'];
  $strSql = 'SELECT id, book, chapter, verse, content FROM scriptures WHERE book = :searchBook';
  $statement = $db->prepare($strSql);
  $statement->bindValue(':searchBook', $searchBook, PDO::PARAM_STR);
  $statement->execute();
  $displaySearch = "<h1>Scripture Search</h1>";

  while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    $displaySearch .= "<a href='detail.php?id=$row[id]'><p><strong>$row[book]&nbsp$row[chapter]:$row[verse]</strong>";
    $displaySearch .= "'</p></a>";

  }
}

// for the checkboxes of topics
$query = 'SELECT id, name FROM topic';
$stmt = $db->prepare($query);
$stmt->execute();
$topics = $stmt->fetchAll(PDO::FETCH_ASSOC);



?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <?
    echo $display;
  ?>
  <form method="POST" action="">
    <label for="search"></label>
    <input type="text" name="search">
    <input type="submit" name="submit" value="Search">
  </form>
  <?
  if (isset($displaySearch)) {
    echo $displaySearch;
  }
  
  ?>

  <form method="POST" action="insert_scripture.php">
    <label>Book</label>
    <input type="text" name="book">
    <label>Chapter</label>
    <input type="text" name="chapter">
    <label>Verse</label>
    <input type="text" name="verse">
    <label>Content of Scripture</label>
    <textarea name="content" rows="10" cols="50"></textarea>
    <?php
      foreach ($topics as $topic) {
        $topicid = $topic['id'];
        $topicname = $topic['name'];

        echo "<input type='checkbox' name='topic' value='$topicid'>";
        echo "<label for='topic'>$topicname</label><br>";
      }

    ?>
    
    <input type="submit" name="submit" value="Add Scripture">
  </form>
</body>

</html>