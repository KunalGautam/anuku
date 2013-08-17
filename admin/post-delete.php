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

	$query = sprintf("delete from `data` where id = %d", $id);

	$results = $dbobj -> sqlQuery($query);

	if ($results) {

		$dbobj -> disconnect();
		$_SESSION['session_alert'] = "Post Deleted";
        $_SESSION['session_flag'] = "alert-error";
		header('Location:home.php');
		exit();
	}

} elseif (isset($_POST['deletecancel'])) {
	$_SESSION['session_alert'] = "Delete Cancelled";
    $_SESSION['session_flag'] = "alert";
	header('Location:home.php');
	exit();

}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>AnuKu - Content Management Simplicity</title>

		<!-- Bootstrap core CSS -->
		<link href="../template/bootstrap/css/bootstrap.css" rel="stylesheet">
		<!-- Custom CSS for Anuku -->
		<link href="../template/bootstrap/css/stickyfooter.css" rel="stylesheet">
		<link href="../template/style.css" rel="stylesheet">
		<link href="../template/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

		<!-- JS beauties go here -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script src="../template/bootstrap/js/bootstrap.js"></script>

	</head>

	<body>
		<!-- Wrap all page content here -->
		<div id="wrap">
			<!-- Homepage title		 -->
			<div class="container">
				<div class="row">
					<div class="span4 offset4">
						<div class="page-header text-center login-page-header-fix">
							<h1><a href="../">Anuku</a></h1>
							<p class="lead">
								Content Management Simplicity
							</p>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="span8 offset2 text-center">
						<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert">
							&times;
						</button><h3 >You really want to delete this post?</h3>
						<p>
							This action cannot be undone !
						</p>
					</div>
					<form action="post-delete.php?id=<?php echo $id; ?>" method="post">
					</div>
				</div>
				<div class="row">
						<div class="span8 offset2">
							<button type="submit" class="btn btn-danger btn-large" name="deleteconfirm">
								Yes Sure, Delete
							</button>
							<button type="submit" class="btn btn-inverse btn-large pull-right" name="deletecancel">
								Do not Delete
							</button>

						</div>
				</div>
				</form>
			</div>
		</div>
		<!-- footer -->
			<div id="footer">
				<div class="container text-center">
					<p class="text-muted credit">
						Anuku | Fork our code at <a href="https://github.com/eanurag/anuku">GitHub</a> | Made with Love &amp; Simplicity
					</p>
				</div>
			</div>
	</body>
</html>