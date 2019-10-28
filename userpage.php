<?php 
session_start();
$pageTitle = 'User Page';
include('includes/header.php'); ?>

<!DOCTYPE html>
<html>
    
<?php include("includes/userpage_functions.php"); ?>
    
<body>
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
  
  if(!isset($_SESSION['user_cart'])){
    $result = pg_query($conn, $cartQuery);
    $_SESSION['user_cart'] = pg_fetch_all($result);
  }
  $cart = $_SESSION['user_cart'];
  displayCart($cart);
?>
  <form method="post">
      <input name="deletebook" type="submit" value="delete" />
      <input name="addbook" type="submit" value="add" />
  </form>
<?php
  /* add to cart */
  if(isset($_POST['addbook'])){
    $new_book = array('book_id' => 9999, 'book_cover' => "9788377858745-us.jpg");
    
    $cart[] = $new_book;
    unset($_POST['addbook']);
    /* set session variable to reflect adding to cart */
    $_SESSION['user_cart'] = $cart;
    /* refresh the page automatically */
    echo "<meta http-equiv='refresh' content='0'>";

  }
  /* delete from cart */
  if(isset($_POST['deletebook'])){
    $len = count($cart);
    if($len >= 1){
      unset($cart[$len-1]);
    }
    unset($_POST['deletebook']);
    $_SESSION['user_cart'] = $cart;
    /* refresh the page  */
    echo "<meta http-equiv='refresh' content='0'>";
  }
  
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
