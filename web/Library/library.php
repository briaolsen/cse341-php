<?php

require_once "database.php";
$db = get_db();

$currentPage = "library";

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

  <?php $IPATH = $_SERVER["DOCUMENT_ROOT"] . "/Library/";
  include($IPATH . "navbar.php"); ?>

  <div class="jumbotron jumbotron-fluid bg-white text-center">
    <div class="container">
      <h1 class="display-4">Olsen Family Library</h1>
      <p class="lead">"Reading is dreaming with eyes wide open."</p>
    </div>
  </div>

  <!--<h1 id="library-header">Olsen Family Library</h1>-->

  <div id="search-results">
    <table class="table table-striped results-table">
      <thead>
        <tr>
          <th scope="col">Book Title</th>
          <th scope="col">Author</th>
          <th scope="col">Genre</th>
          <th scope="col">Lexile</th>
        </tr>
      </thead>


      <?php

      $statement = $db->prepare('SELECT book.title, book.lexile, book.genre, author.first_name, author.last_name FROM book JOIN author ON book.author_id = author.id ORDER BY author.last_name ASC');
      $statement->execute();

      while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $title = $row['title'];
        $lexile = $row['lexile'];
        $genre = $row['genre'];
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];


        echo "<tr>
              <td>$title</td>
              <td>$first_name $last_name</td>
              <td>$genre</td>
              <td>$lexile</td>
           </tr>";
      }
      ?>
    </table>
  </div>



  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>