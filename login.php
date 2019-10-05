
<?php
session_start();
include('includes/header.html');

$page_title = 'Login';

/* Connect to database */
$dbc = pg_connect("host=ec2-54-235-100-99.compute-1.amazonaws.com port=5432 dbname=db8u3gdkjq4l6i user=oihnrigiktbsug password=03f8fa546db912cfc133c1faa898ef14cd26324691f4ba13ee09d89db73c9e8f");

/* Check if the form has been submitted: */
if (isset($_POST['sub'])) {

	$errors = []; // Initialize error array.
	$u = stripslashes($_POST['uname']);
	$p = stripslashes($_POST['pass']);
	$uname = pg_escape_string($dbc, trim($u));
	$pwd = pg_escape_string($dbc, trim($p));

	if (empty($errors)) {
		/* Retrieve the firstname and lastname for that username/password combination: */
		$q = "SELECT firstname, lastname FROM users WHERE username='$uname' AND password='$p'";
		$r = @pg_query($dbc, $q); // Run the query.
		
		/* Database: firstname, lastname, username, password, email */
		if ($arr = pg_fetch_array($r)) {
			$_SESSION['user'] = $uname;
			$_SESSION['fname'] = $arr[0];
			$_SESSION['lname'] = $arr[1];
			
		}
		else {
			$error = 'The username and password entered do not match.';
		}
		
	}		

	pg_close($dbc); // Close the database connection.

} // End of the main submit conditional.

?>


</header>
<div class="login-page">
<div class="form">
	<p style="color:red;"><b><?php echo $error;?></b></p>
	<p style="color:green;paddingleft:50px;"><b><?php
		if (isset($_SESSION['user'])){
			echo "You are now logged in, ".$_SESSION['fname'];
		}?></b></p>
	<form class="login-page" action="login.php" method="post">
		<ul style="list-style-type: none";>
			<li><label><b>Username</b></label></li>
			<input type="text" name="uname" value="<?php if(isset($_POST['uname'])) echo $_POST['uname']; ?>" required>
			<li><label><b>Password</b></label></li>
			<input type="password" name="pass" value="" required>
			<li><b>New User Click <a href="register.php">here</b></a></li><br>
			<li><button type="submit" name="sub">Login</button></li>
		</ul>
	</form>
</div>
</div>

<?php include('includes/footer.html'); ?>