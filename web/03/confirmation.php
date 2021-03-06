<?php
session_start();

// "Name" => array( "Age"   => string
//                  "Breed" => string
//                  "Price" => int
//                  "URL"   => string            );
$pets = [
  "Poppy" => array(
    "Age"   => "2 years",
    "Breed" => "Australian Shepherd Collie Mix",
    "Price" => "200",
    "URL"   => "https://cdn.pixabay.com/photo/2019/07/01/11/23/dog-4309752_960_720.jpg"
  ),
  "Max" => array(
    "Age"   => "3 years",
    "Breed" => "Long-haired Chihuahua",
    "Price" => "200",
    "URL"   => "https://cdn.pixabay.com/photo/2017/10/29/18/00/chihuahua-2900362_960_720.jpg"
  ),
  "Milo" => array(
    "Age"   => "8 years",
    "Breed" => "Lab Mix",
    "Price" => "150",
    "URL"   => "https://cdn.pixabay.com/photo/2014/04/05/11/38/dog-316459_960_720.jpg"
  ),
  "Charlie" => array(
    "Age"   => "7 years",
    "Breed" => "Terrier Mix",
    "Price" => "150",
    "URL"   => "https://cdn.pixabay.com/photo/2014/04/05/11/40/dog-316598_960_720.jpg"
  ),
  "Bella" => array(
    "Age"   => "4 years",
    "Breed" => "Australian Shepherd",
    "Price" => "200",
    "URL"   => "https://cdn.pixabay.com/photo/2016/03/22/13/25/dog-1272872_960_720.jpg"
  ),
  "Brittany" => array(
    "Age"   => "5 years",
    "Breed" => "Boxer",
    "Price" => "200",
    "URL"   => "https://cdn.pixabay.com/photo/2016/03/24/22/53/boxer-1277804_960_720.jpg"
  ),
];

if (!isset($_SESSION['cost'])) {
  $_SESSION['cost'] = 0;
}

if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = array();
}

$firstname = (isset($_POST['inputFirstName'])) ? filter_var($_POST['inputFirstName'], FILTER_SANITIZE_STRING) : '';
$lastname = (isset($_POST['inputLastName'])) ? filter_var($_POST['inputLastName'], FILTER_SANITIZE_STRING) : '';
$address = (isset($_POST['inputAddress'])) ? filter_var($_POST['inputAddress'], FILTER_SANITIZE_STRING) : '';
$address2 = (isset($_POST['inputAddress2'])) ? filter_var($_POST['inputAddress2'], FILTER_SANITIZE_STRING) : '';
$city = (isset($_POST['inputCity'])) ? filter_var($_POST['inputCity'], FILTER_SANITIZE_STRING) : '';
$state = (isset($_POST['inputState'])) ? filter_var($_POST['inputState'], FILTER_SANITIZE_STRING) : '';
$zip = (isset($_POST['inputZip'])) ? filter_var($_POST['inputZip'], FILTER_SANITIZE_STRING) : '';

session_destroy();
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Week 03 - Checkout</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>

  <!-- External CSS -->
  <link rel="stylesheet" type="text/css" href="styles.css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Cardo%7CCourgette%7CDosis%7CGalada&display=swap" rel="stylesheet">

</head>

<body>
  <div class="bg-dark">

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="items.php">
        <h3 class="cardo">Furever Adoptions</h3>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="items.php">Browse Animals</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <a href="cart.php" class="btn btn-outline-light my-2 my-sm-0" style="font-size:16px">Shopping Cart <i class="fa fa-shopping-cart"></i></a>
        </form>
      </div>
    </nav>

    <!-- JUMBOTRON -->
    <div class="jumbotron jumbotron-fluid px-5">
      <h1 class="display-4 text-lg-left cardo"><i class='fas fa-paw'></i> Confirmation <i class='fas fa-paw'></i></h1>
    </div>

    <!-- CART CONTENTS -->
    <div class="reviewContainer float-right">
      <table class="table table-striped table-bordered table-light cart-table">

        <thead class="thead-light">
          <tr>
            <th colspan="2">
              <h4 class="cardo">Purchase</h4>
            </th>
          </tr>
        </thead>

        <tbody>
          <?php
          foreach ($_SESSION['cart'] as $num => $itemName) : ?>
            <tr>
              <td><?php echo $itemName; ?></td>
              <td><span class="float-right">$<?php echo $pets[$itemName]['Price']; ?></span></td>

            </tr>
          <?php endforeach; ?>

          <tr>
            <th>Total: </th>
            <th><span class="float-right">$<?php echo $_SESSION['cost']; ?></span></th>
          </tr>
        </tbody>

      </table>
    </div>

    <!-- RECEIPT -->

    <div class="formContainer bg-light">
      <h3 class="cardo">Thank you for choosing adoption!</h3>
      <h6 class="text-muted">Your new pet will make it's way home to:</h6>
      <hr>
      <table>
        <tr>
          <td><?php echo $firstname . " " . $lastname; ?></td>
        </tr>
        <tr>
          <td><?php echo $address; ?></td>
        </tr>
        <tr>
          <td><?php echo $address2; ?></td>
        </tr>
        <tr>
          <td><?php echo $city . ", " . $state . " " . $zip; ?></td>
        </tr>
      </table>
    </div>

    <div class="full-height bg-dark">
    </div>

  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>