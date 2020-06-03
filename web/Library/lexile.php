<?php

$currentPage = "lexile";

$grades = array("K" => "BR160L - 150L", "1" => "165L - 570L", "2" => "425L - 795L", "3" => "645L - 985L", "4" => "850L - 1160L", "5" => "950L - 1260L", "6" => "1030L - 1340L", "7" => "1095L - 1401L", "8" => "1155L - 1470L", "9" => "1205L - 1520L", "10" => "1250L - 1570L", "11" => "1295L - 1610L", "12" => "1295L - 1610L");

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

  <title>Olsen Home Library Lexile Levels</title>
</head>

<body id="search-body">

  <?php $IPATH = $_SERVER["DOCUMENT_ROOT"] . "/Library/";
  include($IPATH . "navbar.php"); ?>

  <div id="lexile-table">
    <table class="table table-striped results-table">
      <thead>
        <tr>
          <th scope="col">Grade</th>
          <th scope="col">Lexile</th>
        </tr>
      </thead>
      <?php foreach ($grades as $grade => $grade_lexile) : ?>
        <tr>
          <td><?php echo $grade; ?></td>
          <td><?php echo $grade_lexile; ?></td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>