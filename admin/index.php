<?php

include 'login-logout.php';

// start a new session and login
$sessionmanagement = new session_management();

$sessionmanagement -> session_login();
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
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="../template/bootstrap/js/bootstrap.js"></script>

    </head>

    <body>
        <!-- Wrap all page content here -->
        <div id="wrap">
            <!-- Homepage title      -->
                <div class="container">
                    <div class="row">
                        <div class="span4 offset4">
                            <div class="page-header text-center login-page-header-fix">
                                <h1><a href="../">Anuku</a></h1>
                                <p class="lead">
                                    Content Management Simplicity
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="span4 offset4 well">
                                <legend class="text-center">
                                    Login to continue
                                </legend>
                                <!-- alert message popup for invalid/empty login credentials -->
                                <?php if(isset($error)) {
                                ?>
                                <div class="alert alert-error text-center">
                                    <button type="button" class="close" data-dismiss="alert">
                                        &times;
                                    </button><?php echo $error; ?>
                                </div>
                                <?php } ?>
                                <form method="POST" action="index.php" accept-charset="UTF-8">
                                    <input type="text" id="username" class="span4 text-center" name="username" placeholder="Username">
                                    <input type="password" id="password" class="span4 text-center" name="pass" placeholder="Password">
                                    <button type="submit" name="submit" class="btn btn-primary btn-large btn-block">
                                        Login <i class="icon-user"></i>
                                    </button>
                                </form>
                                <br />
                                <ul class="pager"><li class="previous"><a href="../"><i class="icon-arrow-left"></i> Back to home</a></li</ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- footer -->
            <div id="footer">
                <div class="container text-center">
                    <p class="text-muted credit">
                        Anuku | Fork our code at <a href="https://github.com/eanurag/cms">GitHub</a> | Made with Love &amp; Simplicity
                    </p>
                </div>
            </div>

    </body>
</html>