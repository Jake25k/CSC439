<?php
	include("includes/header.php");
	include("includes/book_style.php");
?>
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
