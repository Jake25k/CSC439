<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Books</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
    crossorigin="anonymous" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
    crossorigin="anonymous">
  <link rel="stylesheet" href="styles/Style.css" />
  <link rel="stylesheet" href="styles/mobile-style.css">
</head>

<body>
  <header>
    <div class="container-fluid p-0">
      <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="Index.html">
          <i class="fas fa-book-reader fa-2x mx-3"></i>Books</a>
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
              <a class="nav-link" href="books.php">BOOK INVENTORY</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="users.php">USERS
				<span class="sr-only">(current)</span>
			  </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.html">ABOUT</a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
</header>
<h1>Search Results</h1>
<main>
<?php
$conn = pg_connect("host=ec2-54-235-100-99.compute-1.amazonaws.com port=5432 dbname=db8u3gdkjq4l6i user=oihnrigiktbsug password=03f8fa546db912cfc133c1faa898ef14cd26324691f4ba13ee09d89db73c9e8f");
if (!$conn) {
  echo "An error with the connection occurred.\n";
  exit;
}
    
if (!empty($_POST['term'])) {
    $term = $_POST['term'];  
    
    $query = pg_query($conn, "SELECT * FROM books WHERE title LIKE '$term%'");
    
    if (!$query) {
        echo "An error with the query occurred.\n";
        exit;
    }
    else {
        echo "<table>";
        echo "<tr><th>Title</th><th>Author</th><th>ISBN</th></tr>";
        while($results = pg_fetch_array($query, NULL, PGSQL_BOTH)){
            echo "<tr>";
            echo "<td>" . $results['title'] . "</td>";
            echo "<td>" . $results['author'] . "</td>";
            echo "<td>" . $results['isbn'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
}
else {
    echo "You didn't search for anything!";
}
?>
</main>
</body>
</html>