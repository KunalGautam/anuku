<?php

include 'DatabaseConnection.php';

$dbobj = new DBConnect();

$dbobj -> connect();

$query = 'select * from data';

$results = $dbobj -> sqlQuery($query);
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
				<ol>
					<!-- this part of code needs to have check for syntax errors -->
					<?php while ($row = mysql_fetch_array($results, MYSQL_ASSOC)) {
					?>
					<li>
						<a href="article.php?id=<?php echo "{$row['id']}"; ?>"> <?php echo "{$row['name']}"; ?></a>
					</li>
					<?php } ?>
				</ol>

			</div>
		</div>
	</body>
</html>