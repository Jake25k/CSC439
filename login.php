
<?php
include('includes/header.html');

// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// Need helper files:
	require('includes/login_functions.inc.php');
	
	// Connect to database
	$dbc = pg_connect("host=ec2-54-235-100-99.compute-1.amazonaws.com port=5432 dbname=db8u3gdkjq4l6i user=oihnrigiktbsug password=03f8fa546db912cfc133c1faa898ef14cd26324691f4ba13ee09d89db73c9e8f");

	// Check the login:
	list ($check, $data) = check_login($dbc, $_POST['uname'], $_POST['pass']);

	if ($check) { // OK!

		// Set the session data:
		session_start();
		$_SESSION['email'] = $data['email'];
		$_SESSION['firstname'] = $data['fname'];
		$_SESSION['lastname'] = $data['lname'];

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
			echo '</p><p>Please try again.</p>';

	}

	pg_close($dbc); // Close the database connection.

} // End of the main submit conditional.

?>



<div class="login-page">
<div class="form">
	<form class="login-page" action="login.php" method="post">
		<ul style="list-style-type: none";>
			<li><label><b>Username</b></label></li>
			<input type="text" name="uname" value="<?php if(isset($_POST['uname'])) echo $_POST['uname']; ?>">
			<li><label><b>Password</b></label></li>
			<input type="password" name="pass" value="">
			<li><b>New User Click <a href="register.php">here</b></a></li><br>
			<li><button type="submit">Login</button></li>
		</ul>
	</form>
</div>
</div>

<?php include('includes/footer.html'); ?>