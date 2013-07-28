<?php

session_start();

include '../DatabaseConnection.php';

$id = $_GET['id'];

if (!isset($_SESSION['logged_in'])) {

	header('Location:index.php');
	exit();

}

if (isset($_POST['deleteconfirm'])) {

	$dbobj = new DBConnect();

	$dbobj -> connect();

	$query = sprintf("delete from `data` where `id` = %d", $id);

	$results = $dbobj -> sqlQuery($query);

	if ($results) {

		$dbobj -> disconnect();
		header('Location:home.php');
		exit();
	}

} elseif (isset($_POST['deletecancel'])) {

	header('Location:home.php');
	exit();

}
?>

<html>
	<head>
		<title> Admin Area of CMS ! Delete Post</title>
		<link rel="stylesheet"	type="text/css"	href="../template/style.css"/>
	</head>
	<body>
		<div id="container">
			<div id="logo">
				<h1><a href="../index.php">CMS</a></h1>
				A minimal Content Management System
			</div>
			<div id="content">
				<form action="post-delete.php?id=<?php echo $id; ?>" method="post">
					<div id="deletealert">
						<h3 >You really want to delete this post?</h3>
						<p>
							This action cannot be undone !
						</p>
						<input type="submit" name="deleteconfirm" value="Yes"/>
						<input type="submit" name="deletecancel" value="No"/>
					</div>
				</form>
			</div>
		</div>
	</body>
</html>
