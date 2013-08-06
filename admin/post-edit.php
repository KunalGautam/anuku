<?php

session_start();

include '../DatabaseConnection.php';

if (isset($_SESSION['logged_in']) && (!isset($_POST['update']) && (!isset($_POST['cancel'])))) {

	$id = $_GET['id'];

	$dbobj = new DBConnect();

	$dbobj -> connect();

	$query = sprintf("select * from `data` where id = %d", $id);

	$results = $dbobj -> sqlQuery($query);

	$row = mysql_fetch_array($results, MYSQL_ASSOC);

	if ($results) {

		$dbobj -> disconnect();
	}
} elseif (isset($_POST['update'])) {

	if (isset($_POST['title']) && isset($_POST['postcontent'])) {
		if (empty($_POST['title']) or empty($_POST['postcontent'])) {
			$error = "Title or Content cannot be empty !";
			$notposted = TRUE;
		} else {

			$dbobj = new DBConnect();

			$dbobj -> connect();

			$name = $_POST['title'];

			$postcontent = $_POST['postcontent'];

			$id = $_GET['id'];

			$query = sprintf("update `data` set name='%s',content='%s' where id=%d", mysql_real_escape_string($name), mysql_real_escape_string($postcontent), $id);

			$results = $dbobj -> sqlQuery($query);

			if ($results) {
				$_SESSION['session_alert'] = 'Post updated';
                $_SESSION['session_flag'] = "alert-info";
				$dbobj -> disconnect();
				header('Location:index.php');
				exit();
			}
		}

	}

} elseif (isset($_POST['cancel'])) {
	$_SESSION['session_alert'] = "Changes discarded";
    $_SESSION['session_flag'] = "alert";
	header('Location:home.php');
	exit();

} else {
	header('Location:index.php');
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
		
		<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
		<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>

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
				<div class="span4 offset4">
					<?php if(isset($error)) {
					?>
					<div class="alert alert-error text-center">
						<button type="button" class="close" data-dismiss="alert">
							&times;
						</button><?php echo $error; ?>
					</div>
					<?php }
					?>
					</div>
			</div>
					<form action="post-edit.php?id=<?php echo $_GET['id'];?>" method="post" accept-charset="UTF-8">
					<div class="row">
						<div class="span8 offset2">
							<fieldset>
								<h2>Edit Post</h2>
								<input class="input-block-level title" type="text" name="title" value="<?php
								if (isset($row))
								{ echo "{$row['name']}";
								} elseif (isset($notposted)) {
								echo $_POST['title'];
								} ?>" />	
					<br />
							<textarea class="input-block-level content" rows="15" type="text" name="postcontent"><?php
								if (isset($row)) {
									echo "{$row['content']}";
								} elseif (isset($notposted)) {
									echo $_POST['postcontent'];
								} ?></textarea>
						</div>	
					</div>
					<br />
					<div class="row">
						<div class="span8 offset2">
							<button type="submit" class="btn btn-success btn-large" name="update">
								Save Changes
							</button>
							<button type="submit" class="btn btn-inverse btn-large pull-right" name="cancel">
								Cancel
							</button>

						</div>
					</div>
					</fieldset>
					</form>
			</div>
		</div>
		
		<!-- footer -->
		<div id="footer">
			<div class="container text-center">
				<p class="text-muted credit">
					Anuku | Fork our code at <a href="https://github.com/eanurag/cms">GitHub</a> | Made with Love &amp; Simplicity
				</p>
			</div>
		</div>
	</body>
</html>