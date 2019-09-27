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
              <a class="nav-link" href="users.php">USERS
				<span class="sr-only">(current)</span>
			  </a>
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
// Procces the registration for new user

$page_title = 'Register';

// Check for form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	
	// Connect to database
	$dbc = pg_connect("host=ec2-54-235-100-99.compute-1.amazonaws.com port=5432 dbname=db8u3gdkjq4l6i user=oihnrigiktbsug password=03f8fa546db912cfc133c1faa898ef14cd26324691f4ba13ee09d89db73c9e8f");
	
	// Intialize an error array
	$erros = [];
	
	// Check for first name:
	if (empty($_POST['fname'])){
		$errors[] = 'You forgot to enter your first name.';
	}
	else{
		$fname = pg_escape_string($dbc, trim($_POST['fname']));
	}
	
	// Check for last name:
	if (empty($_POST['lname'])){
		$errors[] = 'You forgot to enter your last name.';
	}
	else{
		$lname = pg_escape_string($dbc, trim($_POST['lname']));
	}
	
	// Check for email:
	if (empty($_POST['email'])){
		$errors[] = 'You forgot to enter your email.';
	}
	else{
		$email = pg_escape_string($dbc, trim($_POST['email']));
	}
	
	// Check for username:
	if (empty($_POST['uname'])){
		$errors[] = 'You forgot to enter your username.';
	}
	else{
		$uname = pg_escape_string($dbc, trim($_POST['uname']));
	}
	
	// Check for password and confirm the two passwords match:
	if (strlen($_POST['pass']) >= 8 && preg_match('/[A-Z]/', $_POST['pass']) && preg_match('/[a-z]/', $_POST['pass']) && preg_match('/[0-9]/', $_POST['pass'])){
		if ($_POST['pass'] != $_POST['pass2']){
			$errors[] = 'Your password did not match the confirmed password.';
		}
		else{
			$pass = pg_escape_string($dbc, trim($_POST['pass']));
		}
	}
	else{
		$errors[] = 'Your password must be at least 8 characters and contain at least one digit, 
					uppercase letter, and lowercase letter.';
	}
	
	// No errors occured: Register the user to the database
	if (empty($errors)){
		// Make the query
		$q = "insert into users (firstname, lastname, username, password, email) values ('$fname', '$lname', '$uname', SHA2('$pass', 512), '$email')";
		$r = pg_query($dbc, $q); // Run the query
		
		// If ran OK:
		if ($r){
			// Print thank you message
			echo '<h1>Thank you!</h1>
			<p>You are now registered!</p><p><br></p>';
		}
		else{ // If it did not run OK.

			// Public message:
			echo '<h1>System Error</h1>
			<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>';		
	} // End of if ($r)
	
	// Close database connection
	pg_close($dbc);
	exit();	
} // End of if ($errors)
	// Report errors
	else{
		echo '<h1>Error!</h1>
			<p class="error">The following error(s) occurred:<br>';
			foreach ($errors as $msg) { // Print each error.
				echo " - $msg<br>\n";
			}
			echo '</p><p>Please try again.</p><p><br></p>';
	}
	pg_close($dbc);
} // End of main submit
?>
<div class="login-page">
<div class="form">
	<form class="register" action="register.php" method="post">
		<ul style="list-style-type: none";>
			<li><label><b>First Name</b></label></li>
			<input type="text" name="fname" value="">
			<li><label><b>Last Name</b></label></li>
			<input type="text" name="lname" value="">
			<li><label><b>Email</b></label></li>
			<input type="email" name="email" value="">
			<li><label><b>Username</b></label></li>
			<input type="text" name="uname" value="">
			<li><label><b>Password</b></label></li>
			<input type="password" name="pass" value="">
			<li><label><b>Confirm Password</b></label></li>
			<input type="password" name="pass2" value="">
			<li><button type="submit" name="submit">Create</button></li>
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