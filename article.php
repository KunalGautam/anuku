<?php
//Check if config is ok. If not redirect to installation
include 'check.php';
require("Db.class.php");

// Retrieve single article from DB
if (isset($_GET['id'])) {
	$db = new Db();
	$id = $_GET['id'];
	$query = sprintf('select * from `data` where id = %d', $id);
	$results 	 =     $db->query($query);
	
} else {
	header('Location: index.php');
	exit();
}
foreach ($results as $row) {
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
		<link href="template/bootstrap/css/bootstrap.css" rel="stylesheet">
		<!-- Custom CSS for Anuku -->
		<link href="template/bootstrap/css/stickyfooter.css" rel="stylesheet">
		<link href="template/style.css" rel="stylesheet">
		<link href="template/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

		<!-- JS beauties go here -->
		<script src="template/bootstrap/js/jquery-1.9.1.min.js"></script>
		<script src="template/bootstrap/js/bootstrap.js"></script>

	</head>

	<body>
		<!-- Wrap all page content here -->
		<div id="wrap">
		<!-- top navigation -->
		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<a class="btn btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a>
					<div class="nav-collapse collapse" id="main-menu">
						<ul class="nav" id="main-menu-left">
							<li>
							    <!-- add new post button -->
								<a href="admin/post-add.php">
                                <button type="submit" class="btn btn-success button-nav">
                                    Add new post <i class="icon-plus-sign"></i>
                                </button>
                                </a>
							</li>
						</ul>
						<!-- right navigation menu -->
						<ul class="nav pull-right" id="main-menu-right">
							<?php
                            if (isset($_SESSION['logged_in'])) { ?>
                            <li>
                                    <a href="#">Welcome <?php echo strtoupper($_SESSION['user']); ?> ! <i class="icon-user"></i></a>
                            </li>
                            <?php } ?>
                            <li>
                                <a rel="tooltip" href="admin/" title="Login to Admin Console">ADMIN <i class="icon-lock"></i></a>
                            </li>
                            <?php
                            if (isset($_SESSION['logged_in'])) { ?>
                            <li>
                                    <a rel="tooltip" href="admin/home.php?logout=true" title="Logout">LOGOUT <i class="icon-off"></i></a>
                            </li>
                            <?php } ?>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<!-- Homepage title		 -->
		<div class="container">
			<div class="span4 offset4">
				<div class="page-header text-center">
					<h1><a href="./">Anuku</a></h1>
					<p class="lead">
						Content Management Simplicity
					</p>
				</div>
			</div>
			<div class="row">
			    <!-- display the title -->
				<div class="span8 offset2">
					<div class="articlecontent">
					<h2><?php echo "{$row['name']}"; ?></h2>
					<?php $postdate = strtotime($row['time']); ?>
					<!-- display posted time -->
					<span class="label label-inverse">
						- posted on <?php echo date('jS F Y, h:i A', $postdate); ?>
					</span>
					<p><?php echo "{$row['content']}"; ?></p>
					<br />
					<ul class="pager"><li class="previous"><a href="./"><i class="icon-arrow-left"></i> Back to home</a></li</ul>
					</div>
				</div>
			</div>
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
<?php
}
?>
