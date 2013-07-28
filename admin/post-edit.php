<?php

session_start();

include '../DatabaseConnection.php';

if (isset($_SESSION['logged_in']) && (!isset($_POST['update']))) {

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
		} else {

			$dbobj = new DBConnect();

			$dbobj -> connect();

			$name = $_POST['title'];

			$postcontent = $_POST['postcontent'];

			$id = $_GET['id'];

			$query = sprintf("update `data` set name='%s',content='%s' where id=%d", $name, $postcontent, $id);

			$results = $dbobj -> sqlQuery($query);

			if ($results) {

				$dbobj -> disconnect();
				header('Location:index.php');
				exit();
			}
		}

	}

} else {
	header('Location:index.php');
	exit();
}
?>

<html>
	<head>
		<title> Admin Area of CMS ! Edit Post</title>
		<link rel="stylesheet"	type="text/css"	href="../template/style.css"/>
	</head>
	<body>
		<div id="container">
			<div id="logo">
				<h1><a href="../index.php">CMS</a></h1>
				A minimal Content Management System
			</div>
			<div id="content">
				<div id="post">
					<h2>Edit Post</h2>
					<?php if(isset($error)) {
					?>
					<div id="errormsg">
						<?php echo $error; ?>
						<br />
						<br />
					</div>
					<?php } ?>
					<form action="post-edit.php?id=<?php echo "{$row['id']}"; ?>" method="post">
						<input class="post-title" type="text" name="title" value="<?php echo "{$row['name']}"; ?>" />
						<br />
						<br />
						<textarea class="post-textarea" type="text" name="postcontent"><?php echo "{$row['content']}"; ?></textarea>
						<br />
						<br />
						<input class="post-submit" type="submit" name="update" size="10" value="Update" />
					</form>
				</div>
			</div>
		</div>
	</body>
</html>