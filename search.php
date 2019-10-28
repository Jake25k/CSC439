<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Search Results</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
    crossorigin="anonymous" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
    crossorigin="anonymous">
  <link rel="stylesheet" href="styles/Style.css" />
  <link rel="stylesheet" href="styles/mobile-style.css">
    <style>
    header{
      padding-left: 5px;
      background: var(--bggradient);
      width: 100%;
    }
	h1 {
		text-align: center;
	}
    table{
      margin: auto;
      padding: 5px;
	  width: 100% !important;
    }
    td{
      padding-right: 15px;
    }
	centered-table{
		margin-left: auto;
		margin-right: auto;
	}
	.column-head{
		text-align: center;
	}
	table.table-bordered{
		border:2px solid black;
		margin-top:20px;
	}
	table.table-bordered > thead > tr > th{
		width: 75% !important;
		border:2px solid black;
	}
	table.table-bordered > tbody > tr > td{
		width: 75% !important;
		border:2px solid black;
	}
  </style>
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
              <input type="text" name="term" placeholder= "Search..." value="<?php echo isset($_POST['term']) ? $_POST['term'] : '' ?>"/>
              <input type="submit" value="Search" />
          </form>
        </div>
          <div class="collapse navbar-collapse" id="navbarNav">
            <div class="mr-auto"></div>
            <ul class="navbar-nav">
              <li class="nav-item active">
                <a class="nav-link" href="index.php">HOME</a>
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
    
    $escapeterm = pg_escape_string($term);
        
    $query = pg_query($conn, "SELECT * FROM books WHERE UPPER(title) LIKE UPPER('%{$escapeterm}%') OR UPPER(author) LIKE UPPER('%{$escapeterm}%') OR CAST(isbn AS text) LIKE UPPER('%{$escapeterm}%')");

    if (!$query) {
        echo "Sorry, we couldn't find that!";
        exit;
    }

    else {
        $numRows = pg_num_rows($query);

        if ($numRows == 0) {
            echo "Sorry, we couldn't find that!";
        }

        else {
            echo "We found " . $numRows . ' books from your search for "' . $escapeterm . '"';
			echo "<table class=\"centered-table table-bordered table-striped table-hover table-responsive\">";
			echo"<thead>";
			echo "<tr class=\"column-head\"><th>Title</th><th>Author</th><th>ISBN</th></tr>";
			echo "</thead>";
			while($results = pg_fetch_array($query, NULL, PGSQL_ASSOC)){
        $i = $results['book_id'];
        echo "<tr>";
				echo "<td><a href='view.php?id=$i'>" . $results['title'] . "</a></td>";
				echo "<td>" . $results['author'] . "</td>";
				echo "<td>" . $results['isbn'] . "</td>";
				echo "</tr>";
			}
			echo "</table>";
        }
    }
}
else {
    echo "You didn't search for anything!";
}
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
