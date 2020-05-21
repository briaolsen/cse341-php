<?php

require_once "database.php";
$db = get_db();


$currentPage = "search";

$genres = array("realistic fiction","historical fiction",  "fantasy", "science fiction", "dystopian", "mystery", "horror", "thriller", "educational");

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

  <div id="search-form">

    <h1>Search for Book</h1>

    <form>

      <div class="form-row">
        <div class="col-md-3 mb-1">
          <label for="firstName">Author First Name</label>
          <input type="text" class="form-control" id="firstName" name="firstName">
        </div>
        <div class="col-md-3 mb-3">
          <label for="lastName">Author Last Name</label>
          <input type="text" class="form-control" id="lastName" name="lastName">
        </div>
      </div>

      <div class="form-row">
        <div class="col-md-6 mb-3">
          <label for="bookTitle">Book Title</label>
          <input type="text" class="form-control" id="bookTitle">
        </div>
      </div>
      <div class="form-row">
        <div class="col-md-6 mb-3">
          <label for="series">Series</label>
          <input type="text" class="form-control" id="series">
        </div>
      </div>

      <div class="form-row">
        <div class="col-md-3 mb-3">
          <label for="genre">Genre</label>
          <select class="custom-select" id="genre" name="genre">
            <option selected disabled value="">Choose...</option>
            <?php foreach ($genres as $genre) : ?>
              <option value="<?php echo str_replace(' ', '', $genre); ?>"><?php echo ucwords($genre); ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-md-3 mb-3">
          <label for="lexile">Lexile</label>
          <input type="number" class="form-control" id="lexile" name="lexile" min="10" step="10">
        </div>
      </div>

      <div class="form-row">
        <div class="col-md-3 mb-3">
          <label for="lexileMin">Lexile Range Min</label>
          <input type="number" class="form-control" id="lexileMin" name="lexileMin" min="10" step="10">
        </div>
        <div class="col-md-3 mb-3">
          <label for="lexileMax">Lexile Range Max</label>
          <input type="number" class="form-control" id="lexileMax" name="lexileMax" min="10" step="10">
        </div>
      </div>

      <button class="btn btn-dark" type="submit">Search</button>
    </form>

  </div>

  <div id="search-results">
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Book Title</th>
        <th scope="col">Series</th>
        <th scope="col">Author</th>
        <th scope="col">Genre</th>
        <th scope="col">Lexile</th>
      </tr>
    </thead>

    
    <?php

    $statement = $db->prepare('SELECT book.title, book.lexile, book.genre, author.first_name, author.middle_name, author.last_name FROM book JOIN author ON book.author_id = author.id');
    $statement->execute();

    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
      $title = $row['title'];
      $lexile = $row['lexile'];
      $genre = $row['genre'];
      $first_name = $row['first_name'];
      $middle_name = $row['middle_name'];
      $last_name = $row['last_name'];
      //$series_name = $row['series_name'];


      echo "<tr>
              <td>$title</td>
              <td>$first_name $middle_name $last_name </td>
              <td>$genre </td>
              <td>$lexile </td>
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