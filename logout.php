<?php

session_start(); // Access the existing session.

include('includes/header.php');

if (session_destroy()) {
	header("Location:index.php");
}

include('includes/footer.html');
?>