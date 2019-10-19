<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>Book Inventory</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
    crossorigin="anonymous" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
    crossorigin="anonymous">
  <link rel="stylesheet" href="styles/Style.css" />
</head>


<body>
  <header>
      <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg">
          <a class="navbar-brand" href="Index.html">
            <i class="fas fa-book-reader fa-2x mx-3"></i>Best Books</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
            aria-label="Toggle navigation">
            <i class="fas fa-align-right text-light"></i>
          </button>
          <div class="search">
            <form action="search.php" method="post">
                <input type="text" name="term" />
                <input type="submit" value="Search" />
            </form>
          </div>
          <div class="collapse navbar-collapse" id="navbarNav">
            <div class="mr-auto"></div>
            <ul class="navbar-nav">
              <li class="nav-item active">
                <a class="nav-link" href="Index.html">HOME</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="books.php">BOOK INVENTORY
  				<span class="sr-only">(current)</span>
  			  </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="about.html">ABOUT</a>
              </li>
  			<li class="nav-item">
                <a class="nav-link" href="login.php">LOGIN</a>
              </li>
            </ul>
          </div>
        </nav>
      </div>
  </header>
  <?php

  $id = $_GET['id']; //get the book id from the url

  $db_con = pg_connect("host=ec2-54-235-100-99.compute-1.amazonaws.com port=5432 dbname=db8u3gdkjq4l6i user=oihnrigiktbsug password=03f8fa546db912cfc133c1faa898ef14cd26324691f4ba13ee09d89db73c9e8f");
  $result = pg_query($db_con, "SELECT * FROM books WHERE book_id=" . $id . ";");
  if (!$result) {
    echo "An error occurred.\n";
    exit;
  }
  else{
    $row = pg_fetch_row($result);
  }
  ?>
<div style="display: flex; justify-content: center;">
  <div class="panel panel-default">
    <div class="panel-heading">
      <?php echo "<br><div style='text-align: center;'><h1> Title: $row[0]</h1></div>"; ?>
    </div>
    <div class="panel-body">
      <div class="row">
        <div class="col-md-4">
          <?php echo "<img src='assets/covers/$row[4]' style='height: 360px;'/>";
                echo "<br><h5>ISBN: $row[2]</h5>";
                echo "<button class='btn btn-primary'>Add to Cart</button><br><br>";
                echo "<button class='btn btn-success'>Add to Wish List</button><br><br>";
                echo "<button class='btn btn-danger'>Add to Watch List</button><br><br>";
                ?>
        </div>
        <div class = "col-md-6">
          <?php echo "<h3> Author: <a href='#'>$row[1]</a></h3><br>";
                echo "<h2>Price: $row[6]</h2><br>";
                echo "<h5> Description:<br>$row[5] </h5>";
                ?>
                <br>
                <br>
                <br>
                <br>
                <h4>Reccomended books: </h4>
        </div>
      </div>
    </div>
  </div>
</div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
  <script src="js/main.js"></script>
</body>
</html>
