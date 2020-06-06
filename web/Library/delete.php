<?php

require_once "database.php";
$db = get_db();

$id = $_GET['id'];
$book = '<h3>' . $_GET['title'] . ' has been deleted from the library.</h3>';

try {
  $statement = $db->prepare('DELETE FROM book WHERE id = :id');
  $statement->bindValue(':id', $id, PDO::PARAM_INT);
  $statement->execute();
} catch (Exception $e) {
  $book = 'An error occured.' . $e->getLine() . ': ' . $e->getMessage();
}

?>


<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylesheet" href="library.css">

  <title>Olsen Home Library</title>
</head>

<body id="search-body">

<div id="delete-message">

  <?php 
  $IPATH = $_SERVER["DOCUMENT_ROOT"] . "/Library/";
  include($IPATH . "navbar.php"); 
  
  echo $book;
  ?>
</div>



</body>

</html>