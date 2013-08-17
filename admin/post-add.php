<?php

session_start();

include '../DatabaseConnection.php';

// separate session check
if (!isset($_SESSION['logged_in'])) {

	header('Location:index.php');
	exit();

}

// check if the post title and content are set before updating the DB with new record
if (isset($_POST['title']) && isset($_POST['postcontent']) && isset($_POST['publish'])) {
	if (empty($_POST['title']) or empty($_POST['postcontent'])) {
		$error = "Title or Content cannot be empty !";
		$notposted = TRUE;
	} else {
		$dbobj = new DBConnect();
		$dbobj -> connect();
		$name = $_POST['title'];
		$postcontent = $_POST['postcontent'];
		$query = sprintf("insert into `data` (name,content) values ('%s','%s')", mysql_real_escape_string($name), mysql_real_escape_string($postcontent));
		$results = $dbobj -> sqlQuery($query);
        //if insert of new post successful, set the successful alert flag
		if ($results) {
			$_SESSION['session_alert'] = "New Post added";
            $_SESSION['session_flag'] = "alert-info";
			$dbobj -> disconnect();
			header('Location:index.php');
		}
	}
}
// if new post cancel, set the cancel alert flag
if (isset($_POST['cancel'])) {
	$_SESSION['session_alert'] = "New Post discarded";
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
        <!-- Disabling the editor plugin for now as it breaks the responsive layout -->
		<!-- <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
		<script type="text/javascript">
			bkLib.onDomLoaded(nicEditors.allTextAreas);
		</script> -->

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
					    <!-- alert message popup for empty post title/content -->
						<?php if(isset($error)) {
						?>
						<div class="alert alert-error text-center">
							<button type="button" class="close" data-dismiss="alert">
								&times;
							</button><?php echo $error; ?>
						</div>
						<?php } ?>
					</div>
				</div>
				<form action="post-add.php" method="post" accept-charset="UTF-8">
					<div class="row">
						<div class="span8 offset2">
							<fieldset>
								<h2>Add New Post</h2>
								<input class="input-block-level title" type="text" name="title" placeholder="Add Title" <?php if(isset($notposted)) { ?>value="<?php echo $_POST['title']; ?>"<?php } ?>/>

								<br />
								<textarea class="input-block-level content" rows="15" type="text" name="postcontent" placeholder="Add Content"><?php if(isset($notposted)) { ?><?php echo $_POST['postcontent']; ?><?php } ?></textarea>
						</div>
					</div>
					<br />
					<div class="row">
						<div class="span8 offset2">
							<button type="submit" class="btn btn-success btn-large" name="publish">
								Publish
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
					Anuku | Fork our code at <a href="https://github.com/eanurag/anuku">GitHub</a> | Made with Love &amp; Simplicity
				</p>
			</div>
		</div>
	</body>
</html>

