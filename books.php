<?php
	include("includes/header.php");
	include("includes/book_style.php");
?>
</header>
<h1>All Books</h1>
<main>
<?php
$display = 10;
if (isset($_GET['p']) && is_numeric($_GET['p'])){
	$pages = $_GET['p'];
}else{
	$db_con = pg_connect("host=ec2-54-235-100-99.compute-1.amazonaws.com port=5432 dbname=db8u3gdkjq4l6i user=oihnrigiktbsug password=03f8fa546db912cfc133c1faa898ef14cd26324691f4ba13ee09d89db73c9e8f");
	$query = pg_query($db_con, "SELECT COUNT(*) from books");
	$row = pg_fetch_array($query, NULL, PGSQL_NUM);
	$records = $row[0];

	if ($records > $display){
		$pages = ceil($records/$display);
	}else{
		$pages = 1;
	}
}
if(isset($_GET['s']) && is_numeric($_GET['s'])){
	$start = $_GET['s'];
}else{
	$start = 0;
}
$db_con = pg_connect("host=ec2-54-235-100-99.compute-1.amazonaws.com port=5432 dbname=db8u3gdkjq4l6i user=oihnrigiktbsug password=03f8fa546db912cfc133c1faa898ef14cd26324691f4ba13ee09d89db73c9e8f");
$query = pg_query($db_con, "SELECT * from books LIMIT $display OFFSET $start");
if(!$query){
	echo "Query error";
}else{
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
if($pages > 1){

	echo '<br /><p>';

	$current_page = ($start/$display) + 1;

	echo '<a href="books.php?s=0&p=' . $pages . '">First</a>		';

	if($current_page != 1){
		echo '<a href="books.php?s=' . ($start - $display) . '&p=' . $pages . '"><<</a>		';
	}
	for ($i = 1; $i <= $pages; $i++){
		if($i != $current_page){
			echo '<a href="books.php?s=' . (($display * ($i-1))) . '&p=' . $pages . '">' . $i . '</a>		';
		} else {
			echo $i . '		';
		}
	}

	if($current_page != $pages) {
		echo '<a href="books.php?s=' . ($start + $display) . '&p=' . $pages . '">>></a>		';
	}

	echo '<a href="books.php?s=' . (($pages - 1) * $display) . '&p=' . $pages . '">Last</a>';
	echo '</p>';
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
