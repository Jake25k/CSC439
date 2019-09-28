<?php 

function redirect_user() {

	// Start defining the URL...
	// URL is http:// plus the host name plus the current directory:
	$url = 'http://csc439.herokuapp.com';

	// Remove any trailing slashes:
	$url = rtrim($url, '/\\');

	// Redirect the user:
	header("Location: $url");
	exit(); // Quit the script.

} // End of redirect_user() function.


function check_login($dbc, $username = '', $pass = '') {

	$errors = []; // Initialize error array.

	// Validate the email address:
	if (empty($username)) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
		$e = pg_escape_string($dbc, trim($username));
	}

	// Validate the password:
	if (empty($pass)) {
		$errors[] = 'You forgot to enter your password.';
	} else {
		$p = pg_escape_string($dbc, trim($pass));
	}

	if (empty($errors)) { // If everything's OK.

		// Retrieve the user_id and first_name for that email/password combination:
		$q = "SELECT first_name, last_name FROM users WHERE email='$e' AND pass=SHA2('$p', 512)";
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