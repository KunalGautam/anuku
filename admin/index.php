<?php

include 'login-logout.php';

$sessionmanagement = new session_management();

$sessionmanagement -> session_login();
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
