
<?php
include('includes/header.html');

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

include('includes/footer.html');

?>