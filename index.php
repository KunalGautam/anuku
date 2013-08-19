<?php
//Check if config is ok. If not redirect to installation
include 'check.php';
// End Of Check

session_start();

include 'DatabaseConnection.php';

// function logic to strip the snippet for article on homepage if the length is > 300
function truncate_content($strip) {
    $strip = substr($strip,0,300);
    $strip = substr($strip,0,strrpos($strip," "));
    return $strip;
}
// end of snippet function

// Retrieve all the artciles from DB to show on homepage
// also can sort the articles based on time
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
							<li class="dropdown">
							    <!-- dropdown to sort the articles based on time -->
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">SORT <i class="icon-time"></i><b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li>
										<a href="index.php?sort=latest"><i class="icon-arrow-up"></i> Latest</a>
									</li>
									<li class="divider"></li>
									<li>
										<a href="index.php?sort=oldest"><i class="icon-arrow-down"></i> Oldest</a>
									</li>
								</ul>
							</li>

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
			<!-- fetch the articles -->
			<div class="row">
				<div class="span8 offset2">
					<ol>
					<?php while ($row = mysql_fetch_array($results, MYSQL_ASSOC)) {
					?>
					<!-- display the title -->
					<li class="article">
						<h4>
						<a href="article.php?id=<?php echo "{$row['id']}"; ?>"> <?php echo "{$row['name']}"; ?></a>
						</h4>
						<!-- display the post snippet -->
						<blockquote class="snippet">
						    <?php
						    $article_content = strip_tags($row['content']);
						      $len = strlen($article_content);
                            if($len >= 300) {
                                $truncated = truncate_content($article_content);
                                echo $truncated;
                            }
                            else {
                                echo $article_content;
                            }
						    ?>
						</blockquote>
						<!-- display posted time -->
						<?php $postdate = strtotime($row['time']); ?>
						<span class="label label-inverse">
						- posted on <?php echo date('jS F Y, h:i A', $postdate); ?>
						</span>
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