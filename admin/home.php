<?php

include '../DatabaseConnection.php';

if (isset($_SESSION['logged_in'])) {

	$dbobj = new DBConnect();

	$dbobj -> connect();

	$query = 'select * from `data` order by `time`  DESC';

	$results = $dbobj -> sqlQuery($query);
} else {
	header('Location:index.php');
	exit();
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
			<br /><br />
			<div id="login-out">
				<!-- fix the logout link/unset the session variable -->
				<a href="#">LOGOUT</a>
			</div>
			<div id="content">
				<ol>
					<?php while ($row = mysql_fetch_array($results, MYSQL_ASSOC)) {
					?>
					<li>
						<div id="title">
						<a href="../article.php?id=<?php echo "{$row['id']}"; ?>"> <?php echo "{$row['name']}"; ?></a>
						</div>
						<?php $postdate = strtotime($row['time']); ?>
						<div id="posttime">
						posted on <?php echo date('jS F Y, h:i A', $postdate); ?>	|	
						<!-- fix the link to edit the post and delete the post -->
						<a href="#">edit</a>	|	
						<a href="post-delete.php?id=<?php echo "{$row['id']}"; ?>">delete</a>
						</div>
					</li>
					<?php } ?>
				</ol>

			</div>
		</div>
	</body>
</html>