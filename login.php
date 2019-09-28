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
// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// Need helper files:
	//require('includes/login_functions.inc.php');
	
	// Connect to database
	$dbc = pg_connect("host=ec2-54-235-100-99.compute-1.amazonaws.com port=5432 dbname=db8u3gdkjq4l6i user=oihnrigiktbsug password=03f8fa546db912cfc133c1faa898ef14cd26324691f4ba13ee09d89db73c9e8f");

	// Check the login:
	list ($check, $data) = check_login($dbc, $_POST['uname'], $_POST['pass']);

	if ($check) { // OK!

		// Set the session data:
		session_start();
		$_SESSION['email'] = $data['email'];
		$_SESSION['firstname'] = $data['firstname'];
		$_SESSION['lastname'] = $data['lastname'];

		// Redirect:
		redirect_user('loggedin.php');

	} else { // Unsuccessful!

		// Assign $data to $errors for login_page.inc.php:
		$errors = $data;
		echo '<h1>Error!</h1>
			<p class="error">The following error(s) occurred:<br>';
			foreach ($errors as $msg) { // Print each error.
				echo " - $msg<br>\n";
			}
			echo '</p><p>Please try again.</p><p><br></p>';

	}

	pg_close($dbc); // Close the database connection.

} // End of the main submit conditional.


function check_login($dbc, $username = '', $pass = '') {

	$errors = []; // Initialize error array.

	// Validate the email address:
	if (empty($username)) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
		$uname = pg_escape_string($dbc, trim($username));
	}

	// Validate the password:
	if (empty($pass)) {
		$errors[] = 'You forgot to enter your password.';
	} else {
		$p = pg_escape_string($dbc, trim($pass));
	}

	if (empty($errors)) { // If everything's OK.

		// Retrieve the user_id and first_name for that email/password combination:
		$q = "SELECT firstname, lastname FROM users WHERE username='$uname' AND password='$p'";
		$r = @pg_query($dbc, $q); // Run the query.

		// Check the result:
		if (pg_num_rows($r) == 1) {

			// Fetch the record:
			$row = pg_fetch_array($r, PGSQL_ASSOC);

			// Return true and the record:
			return [true, $row];

		} else { // Not a match!
			$errors[] = 'The email address and password entered do not match those on file.';
		}

	} // End of empty($errors) IF.

	// Return false and the errors:
	return [false, $errors];

} // End of check_login() function.

?>



<div class="login-page">
<div class="form">
	<form class="login-page" action="login.php" method="post">
		<ul style="list-style-type: none";>
			<li><label for="uname"><b>Username</b></label></li>
			<input type="text">
			<li><label for="pass"><b>Password</b></label></li>
			<input type="password">
			<li><b>New User Click <a href="register.php">here</b></a></li><br>
			<li><button type="submit">Login</button></li>
		</ul>
	</form>
</div>
</div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
  <script src="js/main.js"></script>
</body>
</html>