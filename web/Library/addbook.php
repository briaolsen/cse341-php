<?php

require_once "database.php";
$db = get_db();

$currentPage = "addbook";

$genres = array("adventure", "realistic fiction", "historical fiction", "science fiction", "fantasy", "animal fantasy", "dystopian", "mystery", "horror", "thriller", "educational");

$author_first = "";
$author_last = "";

if (isset($_POST['firstName']) && !empty($_POST['firstName'])) {
  $author_first = filter_var($_POST['firstName'], FILTER_SANITIZE_STRING);
}
if (isset($_POST['lastName']) && !empty($_POST['lastName'])) {
  $author_last = filter_var($_POST['lastName'], FILTER_SANITIZE_STRING);
}

$author_query = 'SELECT id FROM author WHERE first_name = :author_first AND last_name = :author_last';
$author_statement = $db->prepare($author_query);
$author_statement->bindValue(':author_first', $author_first, PDO::PARAM_STR);
$author_statement->bindValue(':author_last', $author_last, PDO::PARAM_STR);
$author_statement->execute();
$author_results = $author_statement->fetchAll(PDO::FETCH_ASSOC);
$id = $author_results['id'];

if($id == NULL) {
  $author_query ='INSERT INTO author(first_name, last_name) VALUES (:author_first, :author_last);';
  $author_statement = $db->prepare($author_query);
  $author_statement->bindValue(':author_first', $author_first, PDO::PARAM_STR);
  $author_statement->bindValue(':author_last', $author_last, PDO::PARAM_STR);
  $author_statement->execute();
  $author_results = $author_statement->fetchAll(PDO::FETCH_ASSOC);
  $id = $author_results['id'];
}

$title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
$genre = filter_var($_POST['genre'], FILTER_SANITIZE_STRING);
$lexile = filter_var($_POST['lexile'], FILTER_SANITIZE_STRING);

$author_query ='INSERT INTO book (title, lexile, genre, author_id) VALUES (:title, :lexile, :genre, :author_id);';
$author_statement = $db->prepare($author_query);
$author_statement->bindValue(':title', $title, PDO::PARAM_STR);
$author_statement->bindValue(':lexile', $lexile, PDO::PARAM_STR);
$author_statement->bindValue(':genre', $genre, PDO::PARAM_STR);
$author_statement->bindValue(':author_id', $id, PDO::PARAM_STR);
$author_statement->execute();
$author_results = $author_statement->fetchAll(PDO::FETCH_ASSOC);


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
      <div class="col-md-6"><img src="https://cdn.pixabay.com/photo/2019/02/14/14/38/book-3996723_960_720.jpg" alt="Book with Heart Pages" class="img-fluid align-middle"></div>

      <div class="col-md-6">
        <h1 id="search-heading">Add a Book to the Library</h1>

        <?php if(!isset($_GET['id']) || count($results) === 0) : ?>
        <form>

          <div class="form-row top-5">
            <div class="col">
              <label for="firstName">Author First Name</label>
              <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo ( (isset($_GET['firstName'])) ? $_GET['firstName'] : ''); ?>">
            </div>
            <div class="col">
              <label for="lastName">Author Last Name</label>
              <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo ( (isset($_GET['lastName'])) ? $_GET['lastName'] : ''); ?>" required>
            </div>
          </div>

          <div class="form-row top-5">
            <div class="col">
              <label for="title">Book Title</label>
              <input type="text" class="form-control" id="title" name="title" value="<?php echo ( (isset($_GET['title'])) ? $_GET['title'] : ''); ?>" required>
            </div>
          </div>

          <div class="form-row top-5">
            <div class="col">
              <label for="genre">Genre</label>
              <select class="custom-select" id="genre" name="genre">
                <option selected disabled value="">Choose...</option>
                <?php foreach ($genres as $genre) : ?>
                  <option value="<?php echo $genre; ?>"><?php echo ucwords($genre); ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col">
              <label for="lexile">Lexile</label>
              <input type="number" class="form-control" id="lexile" name="lexile" min="10" step="10" value="<?php echo ( (isset($_GET['lexile'])) ? $_GET['lexile'] : ''); ?>">
            </div>
          </div>

          <button class="btn btn-dark top-5" type="submit">Search</button>

        </form>
        <?php endif; ?>
      </div>
    </div>
  </div>



  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>