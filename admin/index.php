<?php

include '../DatabaseConnection.php';

session_start();

if (isset($_SESSION['logged_in'])) {
	header('Location:home.php');
	exit();
} else {
	if (isset($_POST['username']) && isset($_POST['pass'])) {
		if (empty($_POST['username']) or empty($_POST['pass'])) {
			$error = "Username or Password cannot be empty !";
		} else {
			$username = $_POST['username'];
			$pass = md5($_POST['pass']);
			$dbobj = new DBConnect();
			$dbobj -> connect();
			$query = sprintf("select * from `user` where username='%s' and password='%s'", $username, $pass);
			$results = $dbobj -> sqlQuery($query);
			$num = mysql_num_rows($results);
			if ($num == 1) {
				$_SESSION['logged_in'] = TRUE;
				header('Location:home.php');
				exit();
			} else {
				$error = "Wrong Username or Password !";
			}
		}
	}
}
?>
<html>
	<head>
		<title> Admin Area of CMS ! </title>
		<link rel="stylesheet"	type="text/css"	href="../template/style.css"/>
	</head>
	<body>
		<div id="container">
			<div id="logo">
				<h1><a href="../index.php">CMS</a></h1>
				A minimal Content Management System
			</div>
			<div id="content">
				<div id="adminlogin">
					<?php if(isset($error)) {
					?>
					<div id="errormsg">
						<?php echo $error; ?>
						<br />
						<br />
					</div>
					<?php } ?>
					<form action="index.php" method="post">
						<input type="text" name="username" placeholder="Username"/>
						<input type="password" name="pass" placeholder="Password"/>
						<input type="submit" value="Login" />
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
