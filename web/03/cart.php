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

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Week 03 - Shopping Cart</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>

  <!-- Jquery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

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
      <h1 class="display-4 text-lg-left cardo"><i class='fas fa-paw'></i> One Step Closer to Your Furrrrever Friend! <i class='fas fa-paw'></i></h1>
    </div>

    <!-- CART CONTENTS -->
    <div class="cartContainer">
      <table class="table table-striped table-bordered table-light cart-table" id="cartTable">

        <thead class="thead-light">
          <tr>
            <th colspan="4">
              <h3 class="cardo">Shopping Cart</h3>
            </th>
          </tr>
        </thead>

        <tbody>
          <?php
          foreach ($_SESSION['cart'] as $num => $itemName) : ?>
            <tr name="<?php echo $itemName; ?>row">
              <td style="width: 150px"><button class="btn btn-outline-dark" colspan="2" onclick="removeRow(this)" name="<?php echo $itemName; ?>" value="<?php echo $itemName; ?>">Remove</button></td>
              <td><img src="<?php echo $pets[$itemName]['URL']; ?>" class="card-img-top centered" alt="<?php echo $name; ?>"></td>
              <td><span class="align-middle"><?php echo $itemName; ?></span></td>
              <td><span class="float-right align-middle">$<?php echo $pets[$itemName]['Price']; ?></span></td>
            </tr>
          <?php endforeach; ?>

          <tr>
            <th></th>
            <th></th>
            <th><span>Total Price:</span></th>
            <th id="total"><span class="float-right">$<?php echo $_SESSION['cost']; ?></span></th>
          </tr>

          <tr>
            <th colspan="2"><button class="btn btn-dark float-left cartButton" onclick="window.location.href='items.php'">Continue Shopping</button></th>

            <th></th>
            <th><button class="btn btn-dark float-right cartButton" onclick="window.location.href='checkout.php'">Checkout</button></th>
          </tr>

        </tbody>

      </table>
    </div>

  </div>

  <script>
    function removeRow(thisbutton) {
      var data = {};
      data['name'] = thisbutton.value;
      var name = "" + thisbutton.value;
      var url = "remove.php";
      var type = "GET";
      $.ajax({
        url: url,
        type: type,
        data: data,
        success: function() {
          var i = thisbutton.parentNode.parentNode.rowIndex;
          document.getElementById("cartTable").deleteRow(i);
          location.reload();
        }
      });
    }
  </script>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>