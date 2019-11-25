<!DOCTYPE html>
<html>
<head>
<?php
  include("includes/userpage_functions.php");

  function test_loggedIn(){
    $tests = 2;
    $passed = 0;

    $_SESSION['user'] = "test";
    if(loggedIn() == true) $passed += 1;

    $_SESSION['user'] = null;
    if(loggedIn() == false) $passed += 1;

    if($tests == $passed){
      return true;
    }else{
      return false;
    }
  }
    
    function test_cart_path_1() {
        $_SESSION['user']) = "chris";
  
        $conn = pg_connect("host=ec2-54-235-100-99.compute-1.amazonaws.com port=5432 dbname=db8u3gdkjq4l6i user=oihnrigiktbsug password=03f8fa546db912cfc133c1faa898ef14cd26324691f4ba13ee09d89db73c9e8f");
                    
        $cartQuery = "select book_id,author,title,book_cover from books where (book_id > 10 AND book_id < 16) AND book_cover != 'nocover.png' OR author='Stephen Hawking' or author='Bjarne Stroustrup';";
                    
        $result = pg_query($conn, $cartQuery);
        
        $this->assertEquals(6, pg_fetch_all($result));
    }
    
    function test_cart_path_2() {
        $_SESSION['user']) = NULL;
  
        $conn = pg_connect("host=ec2-54-235-100-99.compute-1.amazonaws.com port=5432 dbname=db8u3gdkjq4l6i user=oihnrigiktbsug password=03f8fa546db912cfc133c1faa898ef14cd26324691f4ba13ee09d89db73c9e8f");
                    
        $cartQuery = "select book_id,author,title,book_cover from books where (book_id > 10 AND book_id < 16) AND book_cover != 'nocover.png' OR author='Stephen Hawking' or author='Bjarne Stroustrup';";
                    
        $result = pg_query($conn, $cartQuery);
        
        $this->assertEquals(0, pg_fetch_all($result));
    }
    
    
  function test_displayRecommends(){

    $query = "select book_id,author,title,book_cover from books where starts_with(title,'T');";
    $dbc = pg_connect("host=ec2-54-235-100-99.compute-1.amazonaws.com port=5432 dbname=db8u3gdkjq4l6i user=oihnrigiktbsug
                        password=03f8fa546db912cfc133c1faa898ef14cd26324691f4ba13ee09d89db73c9e8f");

    if(!dbc){
      echo "DB connection failure<br>";
      return null;
    }
    $result = pg_query($dbc, $query);
    if(!q){
      echo "Bad query<br>";
      return null;
    }
    $recBooks = pg_fetch_all($result);
    displayRecommends($recBooks);

    return true;
  }
  function test_displayCart(){

    $query = "select author,title,book_cover from books where author='Herbert Schildt' or author='Stephen Hawking' or author='Bjarne Stroustrup';";
    $dbc = pg_connect("host=ec2-54-235-100-99.compute-1.amazonaws.com port=5432 dbname=db8u3gdkjq4l6i user=oihnrigiktbsug password=03f8fa546db912cfc133c1faa898ef14cd26324691f4ba13ee09d89db73c9e8f");

    if(!dbc){
      echo "DB connection failure<br>";
      return null;
    }
    $result = pg_query($dbc, $query);
    if(!q){
      echo "Bad query<br>";
      return null;
    }
    $booksInCart = pg_fetch_all($result);
    displayCart($booksInCart);

    return true;
  }
  function test_displayInfo(){
    $un = "reed"; $f = "Reed"; $l = "Inderwiesche";

    return displayInfo($un, $f, $l);
  }

  function run($test, $testName){
    echo "Running test " . $testName . "...";
    if($test() == true){
      echo "<b style='color:green;'>passed";
    }else{
      echo "<b style='color:red;'>failed";
    }
    echo "</b><br>";
  }
?>
</head>
<body>

<?php
  echo "<h3>User page tests</h3>";
  run(test_loggedIn, "Login");
  run(test_displayRecommends, "Display recommended books");
  run(test_displayCart, "Display Cart");
  run(test_displayInfo, "Display user info");
?>
</body>
</html>
