<?php ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-orange">
      <a class="navbar-brand" href="index.php">Olsen Home Library</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    
      <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <li class="nav-item <?php if($currentPage == "home") echo "active";?>">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item <?php if($currentPage == "search") echo "active";?>">
            <a class="nav-link" href="search.php">Search</a>
          </li>
        </ul>
      </div>
    </nav>

