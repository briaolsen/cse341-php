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
    "Price" => "$200",
    "URL"   => "https://cdn.pixabay.com/photo/2019/07/01/11/23/dog-4309752_960_720.jpg"
  ),
  "Max" => array(
    "Age"   => "3 years",
    "Breed" => "Long-haired Chihuahua",
    "Price" => "$200",
    "URL"   => "https://cdn.pixabay.com/photo/2017/10/29/18/00/chihuahua-2900362_960_720.jpg"
  ),
  "Milo" => array(
    "Age"   => "8 years",
    "Breed" => "Lab Mix",
    "Price" => "$150",
    "URL"   => "https://cdn.pixabay.com/photo/2014/04/05/11/38/dog-316459_960_720.jpg"
  ),
  "Charlie" => array(
    "Age"   => "7 years",
    "Breed" => "Terrier Mix",
    "Price" => "$150",
    "URL"   => "https://cdn.pixabay.com/photo/2014/04/05/11/40/dog-316598_960_720.jpg"
  ),
  "Bella" => array(
    "Age"   => "4 years",
    "Breed" => "Australian Shepherd",
    "Price" => "$200",
    "URL"   => "https://cdn.pixabay.com/photo/2016/03/22/13/25/dog-1272872_960_720.jpg"
  ),
  "Brittany" => array(
    "Age"   => "5 years",
    "Breed" => "Boxer",
    "Price" => "$200",
    "URL"   => "https://cdn.pixabay.com/photo/2016/03/24/22/53/boxer-1277804_960_720.jpg"
  ),
];


if (!isset($_SESSION['cost'])) {
  $_SESSION['cost'] = 0;
}

if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = array();
}

//session_destroy();

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Week 03 - Items</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- External CSS -->
  <link rel="stylesheet" type="text/css" href="styles.css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Cardo%7CCourgette%7CDosis%7CGalada&display=swap" rel="stylesheet">

  <!-- Jquery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <!-- Ajax request to update session variables -->
  <script>
    function purchase(thisbutton) {
      thisbutton.classList.add("btn-dark");
      thisbutton.disabled = true;
      var data = {};
      data['name'] = thisbutton.value;
      var url = "cartContents.php";
      var type = "GET";
      $.ajax({
        url: url,
        type: type,
        data: data,
      });
    }
  </script>
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
          <li class="nav-item active">
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
      <img src="https://cdn.pixabay.com/photo/2018/04/23/14/38/adorable-3344414_960_720.jpg" class="float-left align-self-center mr-5" alt="Dog and Cat" id="jumbo-img">
      <h1 class="display-4 text-lg-left cardo">Pet Adoptions</h1>
      <p class="lead text-muted">Find your furever friend!</p>
      <p>Looking for a pet to keep you company while in quarantine? Adoption is the best option!</p>
    </div>

    <!-- ADOPTION LISTINGS -->
    <div class="card-columns p-5">

      <!-- Make a listing for each element in $pets array -->
      <?php
      foreach ($pets as $name => $petInfo) : ?>

        <div class="card">
          <!-- Image -->
          <img src="<?php echo $petInfo['URL']; ?>" class="card-img-top" alt="<?php echo $name; ?>">
          <!-- Card (Name, Age, Breed) -->
          <div class="card-body">
            <h3 class="card-title galada"><?php echo $name; ?></h3>
            <p class="card-text">Age: <?php echo $petInfo['Age']; ?></p>
            <p class="card-text">Breed: <?php echo $petInfo['Breed']; ?></p>
          </div>
          <!-- Card Footer (Price, Add to Cart) -->
          <div class="card-footer">
            <span><?php echo $petInfo['Price']; ?></span>
            <button class="text-muted float-right cartButton" onclick="purchase(this)" name="<?php echo $name; ?>" value="<?php echo $name; ?>"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
          </div>
        </div>
      <?php endforeach; ?>

    </div>
  </div>

  <!-- Optional JavaScript -->
  <!-- Popper.js, then Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


</body>

</html>