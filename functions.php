<?php

/* Global variable for database connection */
$db_con = pg_connect("host=ec2-54-235-100-99.compute-1.amazonaws.com port=5432 dbname=db8u3gdkjq4l6i
			user=oihnrigiktbsug password=03f8fa546db912cfc133c1faa898ef14cd26324691f4ba13ee09d89db73c9e8f");

/* Functions for login.php */

/* Gets the users username and password and removes any unnecessary characters */
	function userInfo($uname, $pass){
		global $db_con;
		$u = stripslashes($uname);
		$p = stripslashes($pass);
		$user = pg_escape_string($db_con, trim($u));
		$pwd = pg_escape_string($db_con, trim($p));
		return array($user, $pwd);
	}

	/* If the query executes correctly then a session will be created for the user */
	function getSession($r, $uname){
	if ($arr = pg_fetch_array($r)) {
			$_SESSION['user'] = $uname;
			$_SESSION['fname'] = $arr[0];
			$_SESSION['lname'] = $arr[1];
			header("Location:index.php");
			return true;
		}
		else {
			$error = 'The username and password entered do not match!!.';
			return $error;
		}
	}

	/* Functions for index.php */
	function getNumUsers(){
		global $db_con;
		$query = pg_query($db_con, "SELECT COUNT(*) from users");
		$result = pg_fetch_row($query);
		return $result[0];
	}

	function getNumBooks(){
		global $db_con;
		$query = pg_query($db_con, "SELECT COUNT(*) from books");
		$result = pg_fetch_row($query);
		return $result[0];
	}

	/* Functions for register.php */
	function isRegistered($email){
		global $db_con;
		$q = "SELECT count(*) FROM users WHERE email='$email'";
		$r = @pg_query($db_con, $q); // Run the query.
		$result = pg_fetch_row($r);
		if ($result[0] == 0){
			return false;
		}
		return true;
	}

?>
