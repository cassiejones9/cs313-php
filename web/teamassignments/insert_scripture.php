<?php 

$book = test_input($_POST['book']);
$chapter = test_input($_POST['chapter']);
$verse = test_input($_POST['verse']);
$content = test_input($_POST['content']);

function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

require ('connection.php');
$db = get_db();

$stmt = $db->prepare('INSERT INTO scriptures(book, chapter, verse, content) VALUES (:book, :chapter, :verse, :content);');
$stmt->bindValue(':book', $book, PDO::PARAM_STR);
$stmt->bindValue(':chapter', $chapter, PDO::PARAM_INT);
$stmt->bindValue(':verse', $verse, PDO::PARAM_INT);
$stmt->bindValue(':content', $content, PDO::PARAM_STR);
$stmt->execute();

if(isset($stmt)){
    echo "Your scripture was added to the database.";
    echo "<a href='scriptures.php'>Back to Scripture Page</a>";
}

echo $book;
echo $chapter;
echo $verse;
echo $content;

?>