<?php

require_once "database.php";
$db = get_db();

$currentPage = "addbook";

$genres = array("Adventure", "Realistic Fiction", "Historical Fiction", "Science Fiction", "Fantasy", "Animal Fantasy", "Dystopian", "Mystery", "Horror", "Thriller", "Educational");

$book_result = "";

if (isset($_POST['action']) && $_POST['action'] === 'add_book') {

  echo "Author Name " . $_POST['firstName'] . $_POST['lastName'];
  $db->beginTransaction();
  $params = [];
  $author_id = "";

  try {

    $query = "SELECT * FROM author WHERE first_name = ? AND last_name = ?";
    $params[] = filter_var($_POST['firstName'], FILTER_SANITIZE_STRING);
    $params[] = filter_var($_POST['lastName'], FILTER_SANITIZE_STRING);

    $stm = $db->prepare($query);
    $stm->execute($params);
    $results = $stm->fetchAll(PDO::FETCH_ASSOC);
    $author_id = "";

    if ($results && count($results) > 0) {
      $author_id = $results[0]['id'];
    } else {

      $author_query = 'INSERT INTO author(first_name, last_name) VALUES (?, ?);';
      $author_statement = $db->prepare($author_query);
      $author_statement->execute($params);
      $author_id = $db->lastInsertId();
    }

    $book_query = 'SELECT * FROM book (title, lexile, genre, author_id) VALUES (?, ?, ?, ?);';
    $params = [];
    $params[] = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
    $params[] = filter_var($_POST['lexile'], FILTER_SANITIZE_STRING);
    $params[] = filter_var($_POST['genre'], FILTER_SANITIZE_STRING);
    $params[] = $author_id;
    $book_statement = $db->prepare($book_query);
    $book_result = $book_statement->execute($params);

    if (count($book_result) === 0) {

    $book_query = 'INSERT INTO book (title, lexile, genre, author_id) VALUES (?, ?, ?, ?);';
    $book_statement = $db->prepare($book_query);
    $book_result = $book_statement->execute($params);
    $db->commit();
    } else {
      $book_result = "";
      $db->rollback();
    }

  } catch (Exception $e) {
    echo $e->getLine() . ': ' . $e->getMessage();
    $db->rollback();
  }
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

  <title>Olsen Home Library Add a Book</title>
</head>

<body id="search-body">

  <?php $IPATH = $_SERVER["DOCUMENT_ROOT"] . "/Library/";
  include($IPATH . "navbar.php"); ?>


  <div id="search-form">
    <div class="row">
      <div class="col-md-6"><img src="https://cdn.pixabay.com/photo/2014/09/05/18/32/old-books-436498_960_720.jpg" alt="Books on Shelf" class="img-fluid align-middle"></div>

      <div class="col-md-6">
        <h1 id="search-heading">Add a Book to the Library</h1>

        <form>

          <div class="form-row">
            <div class="col">
              <label for="firstName">Author First and Middle Name</label>
              <input type="text" class="form-control" id="firstName" name="firstName" value="" required>
            </div>
            <div class="col">
              <label for="lastName">Author Last Name</label>
              <input type="text" class="form-control" id="lastName" name="lastName" value="" required>
            </div>
          </div>

          <div class="form-row">
            <div class="col">
              <label for="title">Book Title</label>
              <input type="text" class="form-control" id="title" name="title" value="" required>
            </div>
          </div>

          <div class="form-row">
            <div class="col">
              <label for="genre">Genre</label>
              <select class="custom-select" id="genre" name="genre" required>
                <option selected disabled value="">Choose...</option>
                <?php foreach ($genres as $genre) : ?>
                  <option value="<?php echo $genre; ?>"><?php echo ucwords($genre); ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col">
              <label for="lexile">Lexile</label>
              <input type="number" class="form-control" id="lexile" name="lexile" min="10" step="10" value="" required>
            </div>
          </div>

          <input type="hidden" name="action" value="add_book" />
          <button class="btn btn-dark submitbutton" type="submit">Add Book</button>

        </form>
      </div>
    </div>
  </div>

  <div id="addition_results">
    
    <?php echo "The book you added is: " . $book_result;?>
  
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script>
    $("form").submit(function(event) {

      event.preventDefault();

      var data = $("form").serialize();

      $.ajax({
        url: "addbook.php",
        type: "POST",
        data: data,
      });
    });
  </script>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS 
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>-->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>