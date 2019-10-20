<?php
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

	function test(){
		return false;
	}
?>
