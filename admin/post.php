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
					<form action="post.php" method="post">
						<input class="post-title" type="text" name="title" placeholder="Add Title"/>
						<br /><br />
						<textarea class="post-textarea" type="text" name="postcontent" placeholder="Add Content"></textarea>
						<br /><br />
						<input type="submit" size="10" value="Publish" />
					</form>
					</div>
			</div>
		</div>
	</body>
</html>
