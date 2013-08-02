<?php

include '../DatabaseConnection.php';

class session_management {

	// login function which is called from index page of admin console
	// gives error in 2 cases -
	// 1. if either/both username/password are empty
	// 2. if username/password combination does not match
	// on successful login, the user is redirected to admin homepage 'home.php'

	function session_login() {
		global $error;
		session_start();

		if (isset($_SESSION['logged_in'])) {
			header('Location:home.php');
			exit();
		} else {
			if (isset($_POST['username']) && isset($_POST['pass'])) {
				if (empty($_POST['username']) or empty($_POST['pass'])) {
					return $error = "Username or Password cannot be empty !";
				} else {
					$username = $_POST['username'];
					$pass = md5($_POST['pass']);
					$dbobj = new DBConnect();
					$dbobj -> connect();
					$query = sprintf("select * from `user` where username='%s' and password='%s'", mysql_escape_string($username), mysql_escape_string($pass));
					$results = $dbobj -> sqlQuery($query);
					$num = mysql_num_rows($results);
					if ($num == 1) {
						$_SESSION['logged_in'] = TRUE;
						header('Location:home.php');
						exit();
					} else {
						return $error = "Wrong Username or Password !";
					}

					if ($results) {

						$dbobj -> disconnect();
					}
				}
			}
		}
	}

	// logout function to unset the session variable
	// called from 'home.php' and redirects user to 'index.php'

	function session_logout() {

		session_destroy();
		header('Location:index.php');
		exit();

	}

}
?>