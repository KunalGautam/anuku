<?php

session_start();

include '../DatabaseConnection.php';

if (!isset($_SESSION['logged_in'])) {

	header('Location:index.php');
	exit();

}

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
		if ($results) {

			$dbobj -> disconnect();

			header('Location:index.php');
		}
	}
}

if (isset($_POST['cancel'])) {
	header('Location:home.php');
	exit();
}
?>

<html>
	<head>
		<title> Admin Area of CMS ! Add new Post</title>
		<link rel="stylesheet"	type="text/css"	href="../template/style.css"/>
        <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>

	</head>
	<body>
		<div id="container">
			<div id="logo">
				<h1><a href="../index.php">CMS</a></h1>
				A minimal Content Management System
			</div>
			<div id="content">
				<div id="post">
					<h2>Add New Post</h2>
					<?php if(isset($error)) {
					?>
					<div id="errormsg">
						<?php echo $error; ?>
						<br />
						<br />
					</div>
					<?php } ?>
					<form action="post-add.php" method="post">
						<input class="post-title" type="text" name="title" placeholder="Add Title" <?php if(isset($notposted)) { ?>value="<?php echo $_POST['title']; ?>"<?php } ?>/>
						<br />
						<br />
						<textarea class="post-textarea" type="text" name="postcontent" placeholder="Add Content"><?php if(isset($notposted)) { ?><?php echo $_POST['postcontent']; ?><?php } ?></textarea>
						<br />
						<br />
						<input class="post-submit" type="submit" name="publish" size="10" value="Publish" />
						<input class="post-submit" type="submit" name="cancel" size="10" value="Cancel" />
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
