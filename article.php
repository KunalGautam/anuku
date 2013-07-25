<?php

include 'DatabaseConnection.php';

if (isset($_GET['id'])) {
	$dbobj = new DBConnect();
	$dbobj -> connect();
	$id = $_GET['id'];
	$query = sprintf('select * from `data` where id = %d', $id);
	$results = $dbobj -> sqlQuery($query);
	$row = mysql_fetch_array($results, MYSQL_ASSOC);
	if ($row == null) {
		header('Location: index.php');
	}
} else {
	header('Location: index.php');
	exit();
}
?>

<html>
	<head>
		<title> HomePage of CMS ! </title>
		<link rel="stylesheet"	type="text/css"	href="template/style.css"/>
	</head>
	<body>
		<div id="container">
			<div id="logo">
				<h1><a href="index.php">CMS</a></h1>
				A minimal Content Management System
			</div>
			<div id="content">
				<h2><?php echo "{$row['name']}"; ?></h2>
				<?php $postdate = strtotime($row['time']); ?>
				<div id="posttime">
				posted on <?php echo date('jS F Y, h:i A', $postdate); ?>
				</div>
				<p><?php echo "{$row['content']}"; ?></p>
				<br /><br />
				<a href="index.php">&larr;Back to HomePage</a>
			</div>
		</div>
	</body>
</html>