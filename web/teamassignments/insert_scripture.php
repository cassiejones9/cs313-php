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

echo $book;
echo $chapter;
echo $verse;
echo $content;

?>