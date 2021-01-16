<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>CSE 341 | Web Backend Development II</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/styles.css" media="screen">
  <!-- Line 11 fixes favicon error -->
  <link rel="icon" href="data:;base64,iVBORw0KGgo=">
</head>

<body>
  <h1>Cassie Jones</h1>
  <div class="picture">
    <img src="images/cass.jpg">
  </div>
  <h3>A Little About Me</h3>
  <div class="card">
    <ul class="list-group list-group-flush">
      <li class="list-group-item">I'm Cassie from Las Vegas, though I grew up in Boise.</li>
      <li class="list-group-item">I met my husband standing in line at BYU-Idaho.</li>
      <li class="list-group-item">We have 4 kids ages 11, 7, 5, and 3.</li>
      <li class="list-group-item">I'm back in school working on my bachelor's degree in Web Design and Development.</li>
      <li class="list-group-item">I <strong>LOVE</strong> rock climbing and road cycling.</li>
      <li class="list-group-item">Backpacking in Ireland is on the top of my bucket list.</li>
    </ul>
    
  </div>

  <div class="center">
  <a href="/web/assignments.php" class="btn btn-outline-dark">Go to CSE 341 Assignments</a>
  </div>

  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="js/js.js"></script>

  <footer>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/web/common/footer.php'; ?>
  </footer>
</body>

</html>