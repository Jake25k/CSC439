<?php
	$pageTitle = 'View Books';
	include('includes/header.php');
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
</header>
<div style="display: flex; justify-content: center;">
	<div class="panel panel-default">
		<div class="panel-heading">
			<?php echo "<br><div style='text-align: center;'><h1> Title: $row[0]</h1></div>"; ?>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-4">
					<?php 
						echo "<img src='assets/covers/$row[4]' style='height: 360px;'/>";
						echo "<br><h5>ISBN: $row[2]</h5>";
						echo "<form method='post'>";
						echo "<button class='btn btn-primary' name='add_to_cart' value='1'>Add to Cart</button><br><br>";
						echo "<button class='btn btn-success'>Add to Wish List</button><br><br>";
						echo "<button class='btn btn-danger'>Add to Watch List</button><br><br>";
						echo "</form>";
					?>
				</div>
				<div class = "col-md-6">
					<?php 
						echo "<h3> Author: <a href='author.php?author=$id'>$row[1]</a></h3><br>";
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
<?php
	if(isset($_POST['add_to_cart'])){
		$new_book = array('book_id' => $id, 'book_cover' => $row[4]);
		<h5>echo "View<a href='userpage.php'> Cart</a>";</h5>
		$_SESSION['user_cart'][] = $new_book;
	}
?>
<?php include('includes/footer.html'); ?>
