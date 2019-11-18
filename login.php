<?php
    session_start();
    $pageTitle = 'Login';
	include('includes/header.php');
    include('functions.php');

	/* Connect to database */
	$dbc = pg_connect("host=ec2-54-235-100-99.compute-1.amazonaws.com port=5432 dbname=db8u3gdkjq4l6i user=oihnrigiktbsug password=03f8fa546db912cfc133c1faa898ef14cd26324691f4ba13ee09d89db73c9e8f");

	/* Check if the form has been submitted: */
	if (isset($_POST['sub'])) {

		$uname = $_POST['uname'];
		$pwd = $_POST['pass'];

		userInfo($uname, $pwd);

		/* Retrieve the firstname and lastname for that username/password combination: */
		$q = "SELECT firstname, lastname FROM users WHERE username='$uname' AND password=crypt('$pwd', password)";
		$r = @pg_query($dbc, $q); // Run the query.

		$error = getSession($r, $uname);

		pg_close($dbc); // Close the database connection.

	} // End of the main submit conditional.


?>
<link rel="stylesheet" href="styles/loginStyle.css" />
</header>

<div class="container" id="container">
	<div class="form-container sign-up-container">
		<form action="register.php" method="post">
			<h1>Create Account</h1>
			<div class="social-container">
				<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
				<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
				<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
			</div>
			<input type="text" name="fname" placeholder="Firstname" value="<?php if(isset($_POST['fname'])) echo $_POST['fname']; ?>" required>
			<input type="text" name="lname" placeholder="Lastname" value="<?php if(isset($_POST['lname'])) echo $_POST['lname']; ?>" required>
			<input type="email" name="email" placeholder="Email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" required>
			<input type="text" name="uname" placeholder="Username" value="<?php if(isset($_POST['uname'])) echo $_POST['uname']; ?>" required>
			<input type="password" name="pass" placeholder="Password" value="" required>
			<input type="password" name="pass2" placeholder="Confirm Password" value="" required>
			<button>Sign Up</button>
		</form>
	</div>
	<div class="form-container sign-in-container">
		<form action="login.php" method="post">
			<h1>Sign in</h1>
			<input type="text" placeholder="Username" name="uname" value="<?php if(isset($_POST['uname'])) echo $_POST['uname']; ?>" required>
			<input type="password" placeholder="Password" name="pass" value="" required>
			<a href="#">Forgot your password?</a>
			<button type="submit" name="sub">Login</button>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>Welcome Back!</h1>
				<button class="ghost" id="signIn">Login</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>Registration!</h1>
				<button class="ghost" id="signUp">Sign Up</button>
			</div>
		</div>
	</div>
</div>

<script>
var signUpButton = document.getElementById('signUp');
var signInButton = document.getElementById('signIn');
var container = document.getElementById('container');

signUpButton.addEventListener('click', function(){
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', function(){
	container.classList.remove("right-panel-active");
});
</script>

<?php //include('includes/footer.php'); ?>

