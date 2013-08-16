<?php
include '../DatabaseConnection.php';
$dbobj = new DBConnect();
$dbobj->connect();
$username = $_POST['user'];
$password = $_POST['password'];
$email = $_POST['email'];
if ($username == "") {
    header("Location: step2-2.php?error=1"); // redirect if username is blank to step2-2.php.
    exit();
}
if ($email == "") {
    header("Location: step2-2.php?error=3"); // redirect if email is blank to step2-2.php. If it is not blank, check for valid email.
    exit();
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: step2-2.php?error=3");
    exit();
}

if ($password == "") {
    header("Location: step2-2.php?error=2"); // redirect if password is blank to step2-2.php.
    exit();
}
// Storing MD5 Checksum of password and create default post.
$password = md5($password);
$query = "INSERT INTO user (username, password, email) VALUES ('$username', '$password', '$email'); ";
$results = $dbobj->sqlQuery($query);
$query = "INSERT INTO data (name, content) VALUES ('Hello World!', 'Welcome to new AnuKu CMS installation'); ";
$results = $dbobj->sqlQuery($query);
$dbobj->disconnect();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Installation of AnuKu CMS</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/stickyfooter.css" rel="stylesheet">
  </head>
  <body>
    <!-- Wrap all page content here -->
    <div id="wrap">
      <!-- Fixed navbar -->
      <div class="navbar navbar-fixed-top">
        <div class="container">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">AnuKu CMS</a>
          <div class="nav-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="#">Install</a></li>
              <li><a href="release.php">Release Notes</a></li>
              <li><a href="features.php">Features</a></li>
              </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
      <!-- Begin page content -->
      <div class="container">
        <div class="page-header">
          <h1>Final Step:</h1>
        </div>
        <p class="lead">All thing done sucessfully :)</p>
				<form class="form-horizontal" action="delete.php" method="post">
					<div class="row">
					 	 <div class="col-lg-3 col-offset-3">&nbsp;</div>
			  			<div class="col-lg-3 col-offset-3"><button type="submit" class="btn btn-success">Delete install folder and Proceed with New Installation</button></div>
					</div>
			 	 </form>
       </div>
    </div>
    <div id="footer">
      <div class="container">
        <p class="text-muted credit">Fork our code at <a href="https://github.com/eanurag/anuku">GitHub</a></p>
      </div>
    </div>
  </body>
</html>