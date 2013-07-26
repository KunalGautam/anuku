<?php

include '../DatabaseConnection.php';

if (isset($_POST['title']) && isset($_POST['postcontent'])) {
	if (empty($_POST['title']) or empty($_POST['postcontent'])) {
		$error = "Title or Content cannot be empty !";
	} else {
		$dbobj = new DBConnect();
		$dbobj -> connect();
		$name = $_POST['title'];
		$postcontent = $_POST['postcontent'];
		$query = sprintf("insert into `data` (name,content) values ('%s','%s')", $name, $postcontent);
		$results = $dbobj -> sqlQuery($query);
	}
}
?>

<html>
	<head>
		<title> Admin Area of CMS ! Add new Post</title>
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
					<h2>Add New Post</h2>
					<?php if(isset($error)) { ?>
					<div id="errormsg">
						<?php echo $error; ?>
						<br /><br />
					</div>
					<?php } ?>
					<form action="post-add.php" method="post">
						<input class="post-title" type="text" name="title" placeholder="Add Title"/>
						<br />
						<br />
						<textarea class="post-textarea" type="text" name="postcontent" placeholder="Add Content"></textarea>
						<br />
						<br />
						<input class="post-submit" type="submit" size="10" value="Publish" />
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
