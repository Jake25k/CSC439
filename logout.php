<?php include('includes/header.php'); ?>

</header>

<?php

session_start(); // Access the existing session.

if (session_destroy()) {
	header("Location:index.php");
}

include('includes/footer.html');
?>