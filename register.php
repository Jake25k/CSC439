<?php
session_start();
$pageTitle = 'Register';
include('includes/header.php');
include('functions.php');

// Procces the registration for new user

$_SESSION['title'] = 'Register';

// Check for form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	// Connect to database
	$dbc = pg_connect("host=ec2-54-235-100-99.compute-1.amazonaws.com port=5432 dbname=db8u3gdkjq4l6i
										user=oihnrigiktbsug password=03f8fa546db912cfc133c1faa898ef14cd26324691f4ba13ee09d89db73c9e8f");

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

	// Check if user is already registered
	if (isRegistered($email)){
		$errors[] = 'User already exists with this email!';
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
		$q = "insert into users (firstname, lastname, username, password, email)
		values ('$fname', '$lname', '$uname', crypt('$pass', gen_salt('bf')), '$email')";
		$r = pg_query($dbc, $q); // Run the query
        header("Location:login.php");

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
			<p class="error"><b>The following error(s) occurred:</b><br>';
			foreach ($errors as $msg) { // Print each error.
				echo " - <b>$msg</b><br>\n";
			}
			echo '</p><p><b>Please try again.<b></p><p><br></p>';
	}
	pg_close($dbc);
} // End of main submit
?>
</header>
<div class="register">
<div class="form">
	<form class="register" action="register.php" method="post">
		<ul style="list-style-type: none";>
			<li><label><b>First Name</b></label></li>
			<input type="text" name="fname" value="<?php if(isset($_POST['fname'])) echo $_POST['fname']; ?>" required>
			<li><label><b>Last Name</b></label></li>
			<input type="text" name="lname" value="<?php if(isset($_POST['lname'])) echo $_POST['lname']; ?>" required>
			<li><label><b>Email</b></label></li>
			<input type="email" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" required>
			<li><label><b>Username</b></label></li>
			<input type="text" name="uname" value="<?php if(isset($_POST['uname'])) echo $_POST['uname']; ?>" required>
			<li><label><b>Password</b></label></li>
			<input type="password" name="pass" value="" required>
			<li><label><b>Confirm Password</b></label></li>
			<input type="password" name="pass2" value="" required>
			<li><button type="submit" name="submit">Create</button></li>
		</ul>
	</form>
</div>
</div>

<?php include('includes/footer.html'); ?>
