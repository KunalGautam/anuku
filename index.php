<?php

session_start();

$login = FALSE;

if (isset($_SESSION['logged_in'])) {
	
	$login = TRUE;
	
}

include 'DatabaseConnection.php';

$dbobj = new DBConnect();

$dbobj -> connect();

$query = 'select * from `data` order by `time`  DESC';

$results = $dbobj -> sqlQuery($query);

if ($results) {

	$dbobj -> disconnect();
}
?>

<html>
	<head>
		<title> Homepage of CMS ! </title>
		<link rel="stylesheet"	type="text/css"	href="template/style.css"/>
	</head>
	<body>
		<div id="container">
			<div id="logo">
				<h1><a href="index.php">CMS</a></h1>
				A minimal Content Management System
			</div>
			<?php if ($login == FALSE) { ?>
			<br /><br />
			<div id="adminlogin">
				<a href="admin/index.php">LOGIN</a>
			</div>
			<?php } ?>
			<div id="content">
				<ol>
					<?php while ($row = mysql_fetch_array($results, MYSQL_ASSOC)) {
					?>
					<li>
						<div id="title">
						<a href="article.php?id=<?php echo "{$row['id']}"; ?>"> <?php echo "{$row['name']}"; ?></a>
						</div>
						<?php $postdate = strtotime($row['time']); ?>
						<div id="posttime">
						posted on <?php echo date('jS F Y, h:i A', $postdate); ?>
						</div>
					</li>
					<?php } ?>
				</ol>

			</div>
		</div>
	</body>
</html>