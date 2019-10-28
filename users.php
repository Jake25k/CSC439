<?php 
$pageTitle = 'Users';
include('includes/header.php'); ?>

<!DOCTYPE html>
<html lang="en">
<body>
<!-- User login and new user
	<div class="newUser">
		<h2>Create New User</h2>
		<ul style="list-style-type:none;">
			<li><b>Username:</b></li><li><input type="text" name="uname" /></li>
			<li><b>Password:</b></li><li><input type="password" name="pass" /></li>
			<li><b>Confirm Password:</b></li><li><input type="password" name="confirmPass" /></li>
			<li>Already have account<a href="users.php"> click here</a></li>
			<li><input type="submit" /></li>
			
		</ul>		
	</div>
-->

<?php
// Connect to the database
$conn = pg_connect("host=ec2-54-235-100-99.compute-1.amazonaws.com port=5432 dbname=db8u3gdkjq4l6i user=oihnrigiktbsug password=03f8fa546db912cfc133c1faa898ef14cd26324691f4ba13ee09d89db73c9e8f");
if (!$conn) {
  echo "An error occurred.\n";
  exit;
}

// Insert user into database
// $q = "INSERT INTO user VALUES ('$_POST[uname]','$_POST[pass]')";
// $r = pg_query($q);

$result = pg_query($conn, "SELECT firstName FROM users");
if (!$result) {
  echo "An error occurred.\n";
  exit;
}
/*
while ($row = pg_fetch_row($result)) {
  echo "First name: $row[0]";
  echo "<br />\n";
}
*/
?>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
  <script src="js/main.js"></script>
</body>
</html>