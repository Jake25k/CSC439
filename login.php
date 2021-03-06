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
		$q = "SELECT firstname, lastname, created_at, user_status FROM users WHERE username='$uname' AND password=crypt('$pwd', password)";
		$r = @pg_query($dbc, $q); // Run the query.

		$error = getSession($r, $uname);

		pg_close($dbc); // Close the database connection.

        // Refresh page
        echo "<meta http-equiv='refresh' content='0'>";

	} // End of the main submit conditional.


?>
<link rel="stylesheet" href="styles/loginStyle.css" />
</header>


<script src="log.js"></script>

<style>

@import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');

* {
	box-sizing: border-box;
}

body {
	background: #f6f5f7;
	display: flex;
	justify-content: center;
	align-items: center;
	flex-direction: column;
	font-family: 'Montserrat', sans-serif;
	height: 100vh;
	margin: -20px 0 50px;
}

h1 {
	font-weight: bold;
	margin: 0;
}

h2 {
	text-align: center;
}

p {
	font-size: 14px;
	font-weight: 100;
	line-height: 20px;
	letter-spacing: 0.5px;
	margin: 20px 0 30px;
}

span {
	font-size: 12px;
}

a {
	color: #333;
	font-size: 14px;
	text-decoration: none;
	margin: 15px 0;
}

button {
	border-radius: 20px;
	border: 1px solid #FF4B2B;
	background-color: #FF4B2B;
	color: #FFFFFF;
	font-size: 12px;
	font-weight: bold;
	padding: 12px 45px;
	letter-spacing: 1px;
	text-transform: uppercase;
	transition: transform 80ms ease-in;
}

button:active {
	transform: scale(0.95);
}

button:focus {
	outline: none;
}

button.ghost {
	background-color: transparent;
	border-color: #FFFFFF;
}

form {
	background-color: #FFFFFF;
	display: flex;
	align-items: center;
	justify-content: center;
	flex-direction: column;
	padding: 0 50px;
	height: 100%;
	text-align: center;
}

input {
	background-color: #eee;
	border: none;
	padding: 12px 15px;
	margin: 8px 0;
	width: 100%;
}

.container {
	background-color: #fff;
	border-radius: 10px;
  	box-shadow: 0 14px 28px rgba(0,0,0,0.25),
			0 10px 10px rgba(0,0,0,0.22);
	position: relative;
	overflow: hidden;
	width: 768px;
	max-width: 100%;
	min-height: 480px;
}

.form-container {
	position: absolute;
	top: 0;
	height: 100%;
	transition: all 0.6s ease-in-out;
}

.sign-in-container {
	left: 0;
	width: 50%;
	z-index: 2;
}

.container.right-panel-active .sign-in-container {
	transform: translateX(100%);
}

.sign-up-container {
	left: 0;
	width: 50%;
	opacity: 0;
	z-index: 1;
}

.container.right-panel-active .sign-up-container {
	transform: translateX(100%);
	opacity: 1;
	z-index: 5;
	animation: show 0.6s;
}

.overlay-container {
	position: absolute;
	top: 0;
	left: 50%;
	width: 50%;
	height: 100%;
	overflow: hidden;
	transition: transform 0.6s ease-in-out;
	z-index: 100;
}

.container.right-panel-active .overlay-container{
	transform: translateX(-100%);
}

.overlay {
	background: #FF416C;
	background: -webkit-linear-gradient(to right, #FF4B2B, #FF416C);
	background: linear-gradient(to right, #FF4B2B, #FF416C);
	background-repeat: no-repeat;
	background-size: cover;
	background-position: 0 0;
	color: #FFFFFF;
	position: relative;
	left: -100%;
	height: 100%;
	width: 200%;
  	transform: translateX(0);
	transition: transform 0.6s ease-in-out;
}

.container.right-panel-active .overlay {
  	transform: translateX(50%);
}

.overlay-panel {
	position: absolute;
	display: flex;
	align-items: center;
	justify-content: center;
	flex-direction: column;
	padding: 0 40px;
	text-align: center;
	top: 0;
	height: 100%;
	width: 50%;
	transform: translateX(0);
	transition: transform 0.6s ease-in-out;
}

.overlay-left {
	transform: translateX(-20%);
}

.container.right-panel-active .overlay-left {
	transform: translateX(0);
}

.overlay-right {
	right: 0;
	transform: translateX(0);
}

.container.right-panel-active .overlay-right {
	transform: translateX(20%);
}

.social-container {
	margin: 20px 0;
}

.social-container a {
	border: 1px solid #DDDDDD;
	border-radius: 50%;
	display: inline-flex;
	justify-content: center;
	align-items: center;
	margin: 0 5px;
	height: 40px;
	width: 40px;
}
</style>

<div class="container" id="container">
	<div class="form-container sign-up-container">
		<form action="register.php" method="post">
			<h1>Create Account</h1>
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
