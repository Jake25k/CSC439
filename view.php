<?php
	$pageTitle = 'View Books';
	include('includes/header.php');
  include('includes/userpage_functions.php');
	$id = $_GET['id']; //get the book id from the url

	$db_con = pg_connect("host=ec2-54-235-100-99.compute-1.amazonaws.com port=5432 dbname=db8u3gdkjq4l6i user=oihnrigiktbsug password=03f8fa546db912cfc133c1faa898ef14cd26324691f4ba13ee09d89db73c9e8f");
	$result = pg_query($db_con, "SELECT * FROM books WHERE book_id=" . $id . ";");
	if (!$result) {
		echo "An error occurred.\n";
		exit;
	}
	else{
		$row = pg_fetch_array($result);
	}
  //check if book is already in user's cart
  $i = 0;
  $in_cart = 0;
  foreach($_SESSION['user_cart'] as $b){
    if($b['book_id'] == $id){
      $in_cart = 1;
      $book_cart_index = $i;
      break;
    }
    $i++;
  }
  
  function viewRecommended($db_con, $querystr){
    echo "You might like: ";
    $rec_result = pg_query($db_con, $querystr);
    if(!$rec_result){
      echo "Error fetching recommendations!";
    }else{
      $recbooks = pg_fetch_all($rec_result);
      displayRecommends($recbooks);
    }
  }
?>
</header>
<div style="display: flex; justify-content: center;">
	<div class="panel panel-default">
		<div class="panel-heading">
			<?php 
				echo "<br><div style='text-align: center;'><h1> Title: $row[0]</h1></div>";
				if(isset($_POST['add_to_cart'])){
					$new_book = array('book_id' => $id, 'book_cover' => $row[4]);
					echo "<h1 align=\"right\"><font size=\"5 px\"><a class=\"shopping_cart\" href='userpage.php' style=\"color:black\"> <i class=\"fas fa-shopping-cart fa-1x mx-2\" style=\"color:black\"></i>CART</a></font></h1>";
					$_SESSION['user_cart'][] = $new_book;
				}
			?>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-4">
					<?php 
						echo "<img src='assets/covers/$row[4]' style='height: 360px;'/>";
						echo "<br><h5>ISBN: $row[2]</h5>";
						echo "<form method='post'>";
            if($in_cart){
              echo "<button class='btn btn-primary' name='rm_from_cart' value='1'>Remove from Cart</button><br><br>";
            }else{
              echo "<button class='btn btn-primary' name='add_to_cart' value='1'>Add to Cart</button><br><br>";
            }
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
        <?php
          viewRecommended($db_con, "SELECT title,book_id,book_cover from books WHERE category = '" . $row['category'] . "' and book_id != " . $id . " LIMIT 3;");
        ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php 
  if(isset($_POST['rm_from_cart'])){
    if($in_cart){
      unset($_SESSION['user_cart'][$book_cart_index]);
      $cart = array_values($_SESSION['user_cart']);
      $_SESSION['user_cart'] = $cart;
      echo "Removed from cart";
    }else{
      echo "Error: book not in cart! ";
      echo $book_cart_index;
    }
  }
?>

<?php include('includes/footer.html'); ?>
