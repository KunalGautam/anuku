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
          <h1>AnuKu CMS Installation</h1>
        </div>
        <p class="lead">Step 1: <code>Checking Prequisites</code></p>
        <p class="lead">
		<div class="row">
		  	<div class="col-6 col-sm-6 col-lg-6">
              <?php
//Calling require.php for checking the prequisites and assigning scores
include ('require.php');
?></div>
		  	<div class="col-6 col-sm-6 col-lg-6"></div>
		</div>
		<div class="row">
		  	<div class="col-lg-4">&nbsp;</div>
	  		<div class="col-lg-4 col-offset-4">
			<?php
//If any of the prequisites is not fullfiled, score will be less then 2 and hence recheck button will appear.
if ($score < "2") {
    echo "<a href=\"check.php\" type=\"button\" class=\"btn btn-primary\">Recheck Requirements</a>&nbsp;";
    echo "<a href=\"step1.php\" type=\"button\" class=\"btn btn-danger\">Proceed Anyway</a>";
} else {
    echo "<a href=\"step1.php\" type=\"button\" class=\"btn btn-success\">Proceed</a>";
}
?>
			</div>
		</div>
		</p>	
      </div>
    </div>
    <div id="footer">
      <div class="container">
        <p class="text-muted credit">Fork our code at <a href="https://github.com/eanurag/cms">GitHub</a></p>
      </div>
    </div>
  </body>
</html>