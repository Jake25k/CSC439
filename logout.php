<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Books</title>

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
        <a class="navbar-brand" href="Index.html">
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
              <a class="nav-link" href="books.php">BOOK INVENTORY</a>
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

<?php
session_start(); // Access the existing session.

// If no session variable exists, redirect the user:
if (!isset($_SESSION['uname'])) {

	// Need the functions:
	require('includes/login_functions.inc.php');
	redirect_user();

}
else{ // Cancel the session:

	// Save the first and last name
	$fname = $_SESSION['firstname'];
	$lname = $_SESSION['lastname'];
	
	$_SESSION = []; // Clear the variables.
	session_destroy(); // Destroy the session itself.
	setcookie('PHPSESSID', '', time()-3600, '/', '', 0, 0); // Destroy the cookie.

}

// Set the page title and include the HTML header:
$page_title = 'Logged Out!';

// Print a customized message:
echo "<h1>Logged Out!</h1>
<p>You are now logged out $fName $lName!</p>";

?>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
  <script src="js/main.js"></script>
</body>
</html>