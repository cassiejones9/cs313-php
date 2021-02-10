<?php 
require ('connection.php');
$db = get_db();

$book = test_input($_POST['book']);
$chapter = test_input($_POST['chapter']);
$verse = test_input($_POST['verse']);
$content = test_input($_POST['content']);
$topic_ids = $_POST['topic'];

echo $book;
echo $content;
echo $topic_ids;

// function test_input($data)
// {
//   $data = trim($data);
//   $data = stripslashes($data);
//   $data = htmlspecialchars($data);
//   return $data;
// }


// // info just for the scriptures table
// $stmt = $db->prepare('INSERT INTO scriptures(book, chapter, verse, content) VALUES (:book, :chapter, :verse, :content);');
// $stmt->bindValue(':book', $book);
// $stmt->bindValue(':chapter', $chapter);
// $stmt->bindValue(':verse', $verse);
// $stmt->bindValue(':content', $content);
// $stmt->execute();
// // get the scripture_id from above
// $scripture_id = $db->lastInsertId("scriptures_id_seq");
// foreach ($topic_ids as $topic_id){
//     $stmt = $db->prepare('INSERT INTO linking (scripture_id, topic_id) VALUES (:scripture_id, :topic_id);');
//     $stmt->bindValue(':scripture_id', $scripture_id);
//     $stmt->bindValue(':topic_id', $topic_id);
//     $stmt->execute();
// }

// header("Location: showScriptures.php");

// if(isset($stmt)){
//     echo "<h2>Your scripture was added to the database.</h2>";
//     echo "$book $chapter:$verse $content<br>"; 
//     echo "<a href='scriptures.php'>Back to Scripture Page</a>";
// }

?>