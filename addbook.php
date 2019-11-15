<?php session_start() ?>
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
          <a class="navbar-brand" href="index.php">
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
              <li class="nav-item">
                <a class="nav-link" href="books.php">BOOK INVENTORY
  				<span class="sr-only">(current)</span>
  			  </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="about.html">ABOUT</a>
              </li>
              <?php
                if (isset($_SESSION['user'])) {
                  echo '<li class="nav-item"><a class="nav-link" href="logout.php">LOGOUT</a></li>';
                  echo '<li class="nav-item"><a class="nav-link" href="userpage.php">' . $_SESSION['user'] . '<br>Cart: '. count($_SESSION['user_cart']) .' Books</a></li>';
                }
                else {
                  echo '<li class="nav-item"><a class="nav-link" href="login.php">LOGIN</a></li>';
                }
              ?>
            </ul>
          </div>
        </nav>
      </div>
  </header>
<?php
function addBook($title, $author, $isbn, $description){
    $conn = pg_connect("host=ec2-54-235-100-99.compute-1.amazonaws.com port=5432 dbname=db8u3gdkjq4l6i user=oihnrigiktbsug password=03f8fa546db912cfc133c1faa898ef14cd26324691f4ba13ee09d89db73c9e8f");
    if (!$conn) {
      echo "An error occurred.\n";
      exit;
    }

    $q = "insert into books (title, author, isbn, description) VALUES ('" . $title . "', '" . $author . "', " . $isbn . ",'" . $description . "');";
    $r = @pg_query($conn, $q); // Run the query.
    pg_close($dbc); // Close the database connection.

  }

  /* Check if the form has been submitted: */
  if (isset($_POST['sub'])) {

    $title = $_POST['title'];
    $author = $_POST['author'];
    $isbn = $_POST['isbn'];
    $description = $_POST['description'];

    addBook($title, $author, $isbn, $description);
  }
?>

<?php
  if (isset($_POST['sub'])) {

    echo 'Book has been added!';
}
?>
<form action="addbook.php" method="post">
  <ul style="list-style-type: none";>
    <li><label><b>Title:</b></label></li>
    <input type="text" name="title">
    <li><label><b>Author:</b></label></li>
    <input type="text" name="author">
    <li><label><b>ISBN:</b></label></li>
    <input type="text" name="isbn">
    <li><label><b>Description:</b></label></li>
    <input type="text" name="discription">
    <br><br><li><button type="submit" name="sub">Submit</button></li>
  </ul>
</form>
