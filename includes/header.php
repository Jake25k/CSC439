<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title><?php echo $pageTitle; ?></title>

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
        <a class="navbar-brand" href="index.php">
          <i class="fas fa-book-reader fa-2x mx-3"></i>Best Books</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
          aria-label="Toggle navigation">
          <i class="fas fa-align-right text-light"></i>
        </button>
        <div class="search">
          <form action="search.php" method="post">
              <input type="text" name="term" placeholder="Search..."/>
              <input type="submit" value="Search" />
          </form>
        </div>
        <div class="collapse navbar-collapse" id="navbarNav">
          <div class="mr-auto"></div>
          <ul class="navbar-nav">
			<?php session_start();
				if(isset($_SESSION['user'])){
					echo '<li class="nav-item"><a class="nav-link" href="userpage.php">' . $_SESSION['user'] . '</a></li>';
				}
			?>
            <li class="nav-item">
              <a class="nav-link" href="books.php">BOOK INVENTORY</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.php">ABOUT </a>
            </li>
              <?php session_start();
                if (isset($_SESSION['user'])) {
                  echo '<li class="nav-item"><a class="nav-link" href="logout.php">LOGOUT</a></li>';
                    
                    if (!isset($_SESSION['user_cart'])) {
                        $conn = pg_connect("host=ec2-54-235-100-99.compute-1.amazonaws.com port=5432 dbname=db8u3gdkjq4l6i user=oihnrigiktbsug password=03f8fa546db912cfc133c1faa898ef14cd26324691f4ba13ee09d89db73c9e8f");
                    
                        $cartQuery = "select book_id,author,title,book_cover from books where (book_id > 10 AND book_id < 16) AND book_cover != 'nocover.png' OR author='Stephen Hawking' or author='Bjarne Stroustrup';";
                    
                        $result = pg_query($conn, $cartQuery);
                        $_SESSION['user_cart'] = pg_fetch_all($result);
                    }
                    
                  echo '<li class="nav-item"><a class="nav-link" href="userpage.php"> <i class = "fas fa-shopping-cart fa-2x"></i></a></li>';
						echo '<br>Cart: ' . count($_SESSION['user_cart']) . ' Books</li>';
                }
                else {
                  echo '<li class="nav-item"><a class="nav-link" href="login.php">LOGIN</a></li>';
                }
              ?>
          </ul>
        </div>
      </nav>
    </div>
