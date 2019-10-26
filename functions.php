<?php

/* Database connection */


/* Gets the users username and password and removes any unnecessary characters */
	function userInfo($uname, $pass){
		$u = stripslashes($uname);
		$p = stripslashes($pass);
		$user = pg_escape_string($dbc, trim($u));
		$pwd = pg_escape_string($dbc, trim($p));
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

	function getNumUsers(){
		$db_con = pg_connect("host=ec2-54-235-100-99.compute-1.amazonaws.com port=5432 dbname=db8u3gdkjq4l6i
					user=oihnrigiktbsug password=03f8fa546db912cfc133c1faa898ef14cd26324691f4ba13ee09d89db73c9e8f");
		$query = pg_query($db_con, "SELECT COUNT(*) from users");
		$result = pg_fetch_row($query);
		return $result[0];
	}

	function getNumBooks(){
		$db_con = pg_connect("host=ec2-54-235-100-99.compute-1.amazonaws.com port=5432 dbname=db8u3gdkjq4l6i
					user=oihnrigiktbsug password=03f8fa546db912cfc133c1faa898ef14cd26324691f4ba13ee09d89db73c9e8f");
		$query = pg_query($db_con, "SELECT COUNT(*) from books");
		$result = pg_fetch_row($query);
		return $result[0];
	}
?>
