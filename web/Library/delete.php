<?php

require_once "database.php";
$db = get_db();

$id = $_GET['id'];


$statement = $db->prepare('DELETE FROM book WHERE id = :id');
$statement->bindValue(':id', $id, PDO::PARAM_INT);
$statement->execute();
//$results = $statement->fetchAll(PDO::FETCH_ASSOC);

//echo 'The book ' . $results['title'] . ' has been deleted.';


//$book_stmt = $db->prepare('DELETE book WHERE id = ?');
//$book_stmt->bind_param('i')
//$book_stmt->execute($id);
//header("Location: search.php");

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

  <?php 
  $IPATH = $_SERVER["DOCUMENT_ROOT"] . "/Library/";
  include($IPATH . "navbar.php"); 
  
  echo 'The book ' . $results[0]['title'] . ' has been deleted.';
  ?>




</body>

</html>