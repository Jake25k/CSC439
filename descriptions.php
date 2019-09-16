<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
    crossorigin="anonymous" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
    crossorigin="anonymous">
  <link rel="stylesheet" href="styles/Style.css" />
  <style>
    header{
      padding-left: 5px;
      background: var(--bggradient);
      width: 100%;
    }
    table{
      margin: 10px;
      padding: 5px;
    }
    td{
      padding-right: 15px;
    }
  </style>
</head>


<body>

<header>
    <div class="container-fluid p-0">
      <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="#">
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
              <a class="nav-link" href="books.php">BOOK INVENTORY
				<span class="sr-only">(current)</span>
			  </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="users.php">USERS</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.html">ABOUT</a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
</header>

db_con = pg_connect("host=ec2-54-235-100-99.compute-1.amazonaws.com port=5432 dbname=db8u3gdkjq4l6i user=oihnrigiktbsug password=03f8fa546db912cfc133c1faa898ef14cd26324691f4ba13ee09d89db73c9e8f");

$query = pg_query($db_con, "SELECT The Theroy of Everything from books");

<h1> echo "<td>" . $results['title'] . "</td>";</h1>

<main>
<?php

if(!$query){
  echo "Query error";
}else{
  echo "<table>";
  echo "<tr><th>Title</th><th>Author</th><th>ISBN</th></tr>";
  while($results = pg_fetch_array($query, NULL, PGSQL_ASSOC)){
    echo "<tr>";
    echo "<td>" . $results['author'] . "</td>";
    echo "<td>" . $results['isbn'] . "</td>";
    echo "</tr>";
  }
  echo "Price";
  echo "$29.77";
  
  echo "Description";
  echo " The theory of everything is a proposed notion in the scientific community which states that there is 
  one all-encompassing theory that proposes a framework of understanding of all of physics, 
  combining the quantum mechanics and classical physics into a unified approach which explains the laws of the universe."

?>
</main>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
  <script src="js/main.js"></script>
</body>
</html>