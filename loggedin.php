
<?php
include('includes/header.html');

session_start(); // Start the session.

// If no session value is present, redirect the user:
if (!isset($_SESSION['email'])) {

	// Need the functions:
	require('includes/login_functions.inc.php');
	redirect_user();

}

// Set the page title and include the HTML header:
$page_title = 'Logged In!';

// Print a customized message:
echo "<h1>Logged In!</h1>
<p>You are now logged in, {$_SESSION['firstname']} {$_SESSION['lastname']}!</p>
<p><a href=\"logout.php\">Logout</a></p>";

include('includes/footer.html');

?>