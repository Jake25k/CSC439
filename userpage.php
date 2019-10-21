<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>User page</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
    crossorigin="anonymous" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
    crossorigin="anonymous">
  <link rel="stylesheet" href="styles/Style.css" />

  <?php include("includes/userpage_functions.php"); ?>
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
              <input type="text" name="term" placeholder="Search..."/>
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
<div style="display: flex; justify-content: center;">
  <div class="panel panel-default">
<?php
  /* Pretend we are logged in for demonstration. Delete/uncomment the next few lines when login works */
  $username = $_SESSION['user'];
  $firstname = $_SESSION['fname'];
  $lastname = $_SESSION['lname'];
  $recQuery = "select book_id,author,title,book_cover from books where starts_with(title,'T');";
  $cartQuery = "select book_id,author,title,book_cover from books where (book_id > 10 AND book_id < 16) AND book_cover != 'nocover.png' OR author='Stephen Hawking' or author='Bjarne Stroustrup';";

  $conn = pg_connect("host=ec2-54-235-100-99.compute-1.amazonaws.com port=5432 dbname=db8u3gdkjq4l6i user=oihnrigiktbsug password=03f8fa546db912cfc133c1faa898ef14cd26324691f4ba13ee09d89db73c9e8f");
  if(!$conn){
    echo "DB connection error";
    exit;
  }

  /*
  if(isLoggedIn() == false){
    echo "You must log in first.";
    exit;
  }*/
  displayInfo($username, $firstname, $lastname);

  $result = pg_query($conn, $recQuery);
  $rbooks = pg_fetch_all($result);
  displayRecommends($rbooks);

  $result = pg_query($conn, $cartQuery);
  $cbooks = pg_fetch_all($result);
  displayCart($cbooks);

?>
  </div>
</div>
</body>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
  <script src="js/main.js"></script>
</html>
