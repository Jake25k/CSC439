<?php
	$pageTitle = 'View Books';
	include('includes/header.php');
  include('includes/userpage_functions.php');
  
	$id = 29; //book id from test case table

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

  echo "<form method='post'>";
  if($in_cart){
    echo "<button class='btn btn-primary' name='rm_from_cart' value='1'>Remove from Cart</button><br><br>";
    assert($in_cart == true);
    echo "Book in cart";
  }else{
    echo "<button class='btn btn-primary' name='add_to_cart' value='1'>Add to Cart</button><br><br>";
    assert($in_cart == false);
    echo "Book not in cart";
  }
  echo "</form>";

  if(isset($_POST['add_to_cart'])){
    $new_book = array('book_id' => $id, 'book_cover' => $row[4]);
    $_SESSION['user_cart'][] = $new_book;
    echo "<meta http-equiv='refresh' content='0'>";
  }

  if(isset($_POST['rm_from_cart'])){
    if($in_cart){
      unset($_SESSION['user_cart'][$book_cart_index]);
      $cart = array_values($_SESSION['user_cart']);
      $_SESSION['user_cart'] = $cart;
      echo "Removed from cart";
      echo "<meta http-equiv='refresh' content='0'>";
    }else{
      echo "Error: book not in cart! ";
      echo $book_cart_index;
    }
  }
?>