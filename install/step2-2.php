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
          <h1>Site Configuration:</h1>
        </div>
         <?php 
		$error = "";
		if(isset($_GET['error']))
		{
			if($_GET['error']=='1'){
		echo "<code>Username cannot be blank</code>";
			}
			if($_GET['error']=='2'){
		echo "<code>Password cannot be blank</code>";
			}
		}
		?>
        <p class="lead">We require admin details to proceed with setup.</p>
				<form class="form-horizontal" action="final.php" method="post">
					  <div class="form-group">
					    <label class="col-lg-2 control-label">Admin User Name</label>
					    <div class="col-lg-8">
					      <input type="text" class="form-control" name="user" placeholder="Select your desired username">
					    </div>
					  </div>
					  <div class="form-group">
					    <label class="col-lg-2 control-label">Admin Email</label>
					    <div class="col-lg-8">
					      <input type="text" class="form-control" name="email" placeholder="username@domain.tld">
					    </div>
					  </div>
					  
					  <div class="form-group">
					    <label for="inputPassword" class="col-lg-2 control-label">Admin Password</label>
					    <div class="col-lg-8">
					      <input type="password" class="form-control" name="password" placeholder="Password">
					    </div>
					  </div>
					<div class="row">
					 	 <div class="col-lg-3 col-offset-3">&nbsp;</div>
			  			<div class="col-lg-3 col-offset-3"><button type="submit" class="btn btn-success">Create and Proceed</button></div>
					</div>
			 	 </form>
			</div>
    </div>
    <div id="footer">
      <div class="container">
        <p class="text-muted credit">Fork our code at <a href="https://github.com/eanurag/cms">GitHub</a></p>
      </div>
    </div>
 </body>
</html>