<?php

session_start();

include 'login-logout.php';

// destory the session and logout
if (isset($_GET['logout'])) {

	$sessionmanagement = new session_management();

	$sessionmanagement -> session_logout();

}

// check session and retrieve all the artciles from DB
if (isset($_SESSION['logged_in'])) {

	$dbobj = new DBConnect();

	$dbobj -> connect();

	if (!isset($_GET['sort'])) {
		$sorttime = "DESC";
	} elseif ($_GET['sort'] == "oldest") {
		$sorttime = "ASC";
	} else {
		$sorttime = "DESC";
	}

	$query = sprintf("select * from `data` order by `time` %s", $sorttime);

	$results = $dbobj -> sqlQuery($query);

	if ($results) {

		$dbobj -> disconnect();
	}

} else {
	header('Location:index.php');
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
		<script src="../template/bootstrap/js/jquery-1.9.1.min.js"></script>
		<script src="../template/bootstrap/js/bootstrap.js"></script>

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
								<li class="dropdown">
								    <!-- dropdown to sort the articles based on time -->
									<a class="dropdown-toggle" data-toggle="dropdown" href="#">SORT <i class="icon-time"></i><b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li>
											<a href="home.php?sort=latest"><i class="icon-arrow-up"></i> Latest</a>
										</li>
										<li class="divider"></li>
										<li>
											<a href="home.php?sort=oldest"><i class="icon-arrow-down"></i> Oldest</a>
										</li>
									</ul>
								</li>

								<li>
								    <!-- add new post button -->
    								<a href="post-add.php">
                                    <button type="submit" class="btn btn-success button-nav">
                                        Add new post <i class="icon-plus-sign"></i>
                                    </button>
                                    </a>
								</li>
							</ul>
							<!-- right navigation menu -->
							<ul class="nav pull-right" id="main-menu-right">
								<li>
									<a href="#">Welcome <?php echo strtoupper($_SESSION['user']); ?> ! <i class="icon-user"></i></a>
								</li>
								<li>
									<a rel="tooltip" href="../" title="Go back to homepage">HOME <i class="icon-home"></i></a>
								</li>
								<li>
									<a rel="tooltip" href="home.php?logout=true" title="Logout">LOGOUT <i class="icon-off"></i></a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>

			<!-- Homepage title		 -->
			<div class="container">
				<div class="span4 offset4">
					<div class="page-header text-center">
						<h1><a href="../index.php">Anuku</a></h1>
						<p class="lead">
							Content Management Simplicity
						</p>
					</div>
				</div>
				<!-- fetch the articles -->
				<?php if(isset($_SESSION['session_alert']) && isset($_SESSION['session_flag'])) { ?>
					<div class="span4 offset4">
						<div class="alert <?php echo $_SESSION['session_flag']; ?> text-center">
							<button type="button" class="close" data-dismiss="alert">
								&times;
							</button><?php echo $_SESSION['session_alert'];unset($_SESSION['session_alert']); ?>
						</div>
					</div>
				<?php } ?>
			<div class="row">
				<div class="span8 offset2">
					<ol>
					<?php while ($row = mysql_fetch_array($results, MYSQL_ASSOC)) {
					?>
					<!-- display the title -->
					<li class="article">
						<h4>
						<a href="../article.php?id=<?php echo "{$row['id']}"; ?>"> <?php echo "{$row['name']}"; ?></a></h4>
						<div class="row">
						<div class="span8">
						<!-- display posted time -->
						<?php $postdate = strtotime($row['time']); ?>
						<span class="pull-left visible-desktop visible-tablet">
						<span class="label label-inverse">
						- posted on <?php echo date('jS F Y, h:i A', $postdate); ?>
						</span>
						</span>
						<!-- post edit and delete -->
						<!-- only visible on mobile and tablet resolution -->
						<div class="btn-group pull-right visible-tablet visible-phone - posted on 18th August 2013, 10:34 AM ">
							<a class="btn btn-warning btn-small post-manage-buttons" href="post-edit.php?id=<?php echo "{$row['id']}"; ?>"><i class="icon-edit"></i></a>
							<a class="btn btn-danger btn-small post-manage-buttons" href="post-delete.php?id=<?php echo "{$row['id']}"; ?>"><i class="icon-trash"></i></a>
						</div>
						<!-- only visible on desktop resolution, actions for mobile and tablet resolution are up -->
						<div class="btn-group pull-right visible-desktop">
						<a class="btn btn-warning btn-small post-manage-buttons" href="post-edit.php?id=<?php echo "{$row['id']}"; ?>"><i class="icon-edit"></i> Edit</a>
						<a class="btn btn-danger btn-small post-manage-buttons" href="post-delete.php?id=<?php echo "{$row['id']}"; ?>">Delete <i class="icon-trash"></i></a>
						</div>
						</div>
						</div>
					</li>
					<?php } ?>
				</ol>
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