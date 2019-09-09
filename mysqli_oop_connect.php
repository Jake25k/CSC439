<?php # Script 16.1 - mysqli_oop_connect.php
// This file contains the database access information.
// This file also establishes a connection to MySQL,
// selects the database, and sets the encoding.
// The MySQL interactions use OOP!

// Set the database access information as constants:
define('DB_USER', 'spraguez1');
define('DB_PASSWORD', 'csc700');
define('DB_HOST', 'citdb.nku.edu');
define('DB_NAME', 'csc450');

// Make the connection:
$mysqli = new MySQLi(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Verify the connection:
if ($mysqli->connect_error) {
	echo $mysqli->connect_error;
	unset($mysqli);
} else { // Establish the encoding.
	$mysqli->set_charset('utf8');
}

?>
