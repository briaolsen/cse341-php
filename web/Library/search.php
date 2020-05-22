<?php

require_once "database.php";
$db = get_db();


$currentPage = "search";

$genres = array("realistic fiction", "historical fiction", "science fiction", "fantasy", "animal fantasy", "dystopian", "mystery", "horror", "thriller", "educational");

$query = 'SELECT * FROM book JOIN author ON book.author_id = author.id WHERE true';
$params = [];

if (isset($_GET['firstName']) && !empty($_GET['firstName'])) {
  $query  .= ' AND author.first_name ~* ?';
  $params[] = filter_var( $_GET['firstName'], FILTER_SANITIZE_STRING);
}
if (isset($_GET['lastName']) && !empty($_GET['lastName'])) {
  $query  .= ' AND author.last_name ~* ?';
  $params[] = filter_var( $_GET['lastName'], FILTER_SANITIZE_STRING);
}
if (isset($_GET['title']) && !empty($_GET['title'])) {
  $query  .= ' AND book.title ~* ?';
  $params[] = filter_var( $_GET['title'], FILTER_SANITIZE_STRING);
}
if (isset($_GET['genre'])) {
  $query  .= ' AND book.genre ~* ?';
  $params[] = filter_var( $_GET['genre'], FILTER_SANITIZE_STRING);
}
if (isset($_GET['lexile']) && !empty($_GET['lexile'])) {
  $query  .= ' AND book.lexile ~* ?';
  $params[] = filter_var( $_GET['lexile'], FILTER_SANITIZE_STRING);
}

$statement = $db->prepare( $query );
$statement->execute( $params );
$results = $statement->fetchAll(PDO::FETCH_ASSOC);

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
    <div class="row">
      <div class="col-md-6"><img src="https://cdn.pixabay.com/photo/2019/02/14/14/38/book-3996723_960_720.jpg" alt="Book with Heart Pages" class="img-fluid align-middle"></div>

      <div class="col-md-6">
        <h1 id="search-heading">Search for a Book</h1>

        <?php if(!isset($_GET['id']) || count($results) === 0) : ?>
        <form>

          <div class="form-row top-5">
            <div class="col">
              <label for="firstName">Author First Name</label>
              <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo ( (isset($_GET['firstName'])) ? $_GET['firstName'] : ''); ?>">
            </div>
            <div class="col">
              <label for="lastName">Author Last Name</label>
              <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo ( (isset($_GET['lastName'])) ? $_GET['lastName'] : ''); ?>">
            </div>
          </div>

          <div class="form-row top-5">
            <div class="col">
              <label for="title">Book Title</label>
              <input type="text" class="form-control" id="title" name="title" value="<?php echo ( (isset($_GET['title'])) ? $_GET['title'] : ''); ?>">
            </div>
          </div>
          <!--
      <div class="form-row">
        <div class="col-md-6 mb-3">
          <label for="series">Series</label>
          <input type="text" class="form-control" id="series">
        </div>
      </div>-->

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

          <div class="form-row top-5">
            <div class="col">
              <label for="lexileMin">Lexile Range Min</label>
              <input type="number" class="form-control" id="lexileMin" name="lexileMin" min="10" step="10">
            </div>
            <div class="col">
              <label for="lexileMax">Lexile Range Max</label>
              <input type="number" class="form-control" id="lexileMax" name="lexileMax" min="10" step="10">
            </div>
          </div>

          <button class="btn btn-dark top-5" type="submit">Search</button>

        </form>
        <?php endif; ?>
      </div>
    </div>
  </div>

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

  <?php if(isset($_GET['id']) && count($results) > 0) : ?>
    <?php  $result = current($results); ?>
    
    <?php echo $result['title'] . $result['first_name'] . $result['middle_name'] . $result['last_name'] . $result['genre'] . $result['lexile']; ?>
    
<!--
     // while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
      //  $title = $row['title'];
      //  $lexile = $row['lexile'];
       // $genre = $row['genre'];
       // $first_name = $row['first_name'];
        //$middle_name = $row['middle_name'];
       // $last_name = $row['last_name'];
        //$series_name = $row['series_name'];    -->  
        
        <?php elseif ( $results && count($results) > 0 ) : ?>      
        
          <?php 
          if ( $results && count($results) > 0 ) :

          foreach($results as $result) : 

            echo "<tr>
                    <td>" . $result['title'] . "</td>
                    <td>" . $result['first_name'] . " " . $result['middle_name'] . " " . $result['last_name'] ."</td>
                    <td>" . $result['genre'] . "</td>
                    <td>" . $result['lexile'] . "</td>
                  </tr>";

          endforeach;

        endif;
      ?>
    </table>
   <?php endif; ?> 
  </div>
  


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>