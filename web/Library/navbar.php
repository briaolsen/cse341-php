<?php ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-orange">
  <a class="navbar-brand" href="index.php">Olsen Home Library</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item">
        <a class="nav-link" href="../assignments.html">Assignments</a>
      </li>
      <li class="nav-item <?php if ($currentPage == "library") echo "active"; ?>">
        <a class="nav-link" href="library.php">Library</a>
      </li>
      <li class="nav-item <?php if ($currentPage == "search") echo "active"; ?>">
        <a class="nav-link" href="search.php">Search</a>
      </li>
      <li class="nav-item <?php if ($currentPage == "addbook") echo "active"; ?>">
        <a class="nav-link" href="addbook.php">Add Book</a>
      </li>
      <li class="nav-item <?php if ($currentPage == "lexile") echo "active"; ?>">
        <a class="nav-link" href="lexile.php">Lexile</a>
      </li>
    </ul>
  </div>
</nav>


<?php 

if ($currentPage != "home") {

  echo '<div class="jumbotron jumbotron-fluid bg-white text-center">
  <div class="container">
    <h1 class="display-4">Olsen Family Library</h1>
    <p class="lead">"Reading is dreaming with eyes wide open."</p>
  </div>
</div>';
}


?>