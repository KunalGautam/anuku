<?php
/***************************************************************************
*                             sql_parse.php
*                              -------------------
*     begin                : Thu May 31, 2001
*     copyright            : (C) 2001 The phpBB Group
*     email                : support@phpbb.com
*
*     $Id: sql_parse.php,v 1.8 2002/03/18 23:53:12 psotfx Exp $
*
****************************************************************************/

/***************************************************************************
*
*   This program is free software; you can redistribute it and/or modify
*   it under the terms of the GNU General Public License as published by
*   the Free Software Foundation; either version 2 of the License, or
*   (at your option) any later version.
*
***************************************************************************/

/***************************************************************************
*
*   These functions are mainly for use in the db_utilities under the admin
*   however in order to make these functions available elsewhere, specifically
*   in the installation phase of phpBB I have seperated out a couple of
*   functions into this file.  JLH
*
\***************************************************************************/

//
// remove_comments will strip the sql comment lines out of an uploaded sql file
// specifically for mssql and postgres type files in the install....
//
function remove_comments(&$output)
{
    $lines = explode("\n", $output);
    $output = "";

    // try to keep mem. use down
    $linecount = count($lines);

    $in_comment = false;
    for ($i = 0; $i < $linecount; $i++) {
        if (preg_match("/^\/\*/", preg_quote($lines[$i]))) {
            $in_comment = true;
        }

        if (!$in_comment) {
            $output .= $lines[$i] . "\n";
        }

        if (preg_match("/\*\/$/", preg_quote($lines[$i]))) {
            $in_comment = false;
        }
    }

    unset($lines);
    return $output;
}

//
// remove_remarks will strip the sql comment lines out of an uploaded sql file
//
function remove_remarks($sql)
{
    $lines = explode("\n", $sql);

    // try to keep mem. use down
    $sql = "";

    $linecount = count($lines);
    $output = "";

    for ($i = 0; $i < $linecount; $i++) {
        if (($i != ($linecount - 1)) || (strlen($lines[$i]) > 0)) {
            if (isset($lines[$i][0]) && $lines[$i][0] != "#") {
                $output .= $lines[$i] . "\n";
            } else {
                $output .= "\n";
            }
            // Trading a bit of speed for lower mem. use here.
            $lines[$i] = "";
        }
    }

    return $output;

}

//
// split_sql_file will split an uploaded sql file into single sql statements.
// Note: expects trim() to have already been run on $sql.
//
function split_sql_file($sql, $delimiter)
{
    // Split up our string into "possible" SQL statements.
    $tokens = explode($delimiter, $sql);

    // try to save mem.
    $sql = "";
    $output = array();

    // we don't actually care about the matches preg gives us.
    $matches = array();

    // this is faster than calling count($oktens) every time thru the loop.
    $token_count = count($tokens);
    for ($i = 0; $i < $token_count; $i++) {
        // Don't wanna add an empty string as the last thing in the array.
        if (($i != ($token_count - 1)) || (strlen($tokens[$i] > 0))) {
            // This is the total number of single quotes in the token.
            $total_quotes = preg_match_all("/'/", $tokens[$i], $matches);
            // Counts single quotes that are preceded by an odd number of backslashes,
            // which means they're escaped quotes.
            $escaped_quotes = preg_match_all("/(?<!\\\\)(\\\\\\\\)*\\\\'/", $tokens[$i], $matches);

            $unescaped_quotes = $total_quotes - $escaped_quotes;

            // If the number of unescaped quotes is even, then the delimiter did NOT occur inside a string literal.
            if (($unescaped_quotes % 2) == 0) {
                // It's a complete sql statement.
                $output[] = $tokens[$i];
                // save memory.
                $tokens[$i] = "";
            } else {
                // incomplete sql statement. keep adding tokens until we have a complete one.
                // $temp will hold what we have so far.
                $temp = $tokens[$i] . $delimiter;
                // save memory..
                $tokens[$i] = "";

                // Do we have a complete statement yet?
                $complete_stmt = false;

                for ($j = $i + 1; (!$complete_stmt && ($j < $token_count)); $j++) {
                    // This is the total number of single quotes in the token.
                    $total_quotes = preg_match_all("/'/", $tokens[$j], $matches);
                    // Counts single quotes that are preceded by an odd number of backslashes,
                    // which means they're escaped quotes.
                    $escaped_quotes = preg_match_all("/(?<!\\\\)(\\\\\\\\)*\\\\'/", $tokens[$j], $matches);

                    $unescaped_quotes = $total_quotes - $escaped_quotes;

                    if (($unescaped_quotes % 2) == 1) {
                        // odd number of unescaped quotes. In combination with the previous incomplete
                        // statement(s), we now have a complete statement. (2 odds always make an even)
                        $output[] = $temp . $tokens[$j];

                        // save memory.
                        $tokens[$j] = "";
                        $temp = "";

                        // exit the loop.
                        $complete_stmt = true;
                        // make sure the outer loop continues at the right point.
                        $i = $j;
                    } else {
                        // even number of unescaped quotes. We still don't have a complete statement.
                        // (1 odd and 1 even always make an odd)
                        $temp .= $tokens[$j] . $delimiter;
                        // save memory.
                        $tokens[$j] = "";
                    }

                } // for..
            } // else
        }
    }

    return $output;
}
$server = $_POST['server'];
$user = $_POST['user'];
$password = $_POST['password'];
$db = $_POST['db'];


try {
    $dbh = new PDO('mysql:host=' . $server);
    $dbh = null;
}
//If host is alive check if details in config file are ok or not
catch (PDOException $e) {
    header("Location: step1.php?error=0"); //Redirect as server is unreachable
    exit;
}
try {
    $dbh = new PDO('mysql:host=' . $server, $user, $password);
    $dbh = null;
}
catch (PDOException $e) {
    header("Location: step1.php?error=1"); //Redirect as server info is incorrectly fed
    exit;
}
try {
    $dbh = new PDO('mysql:host=' . $server . ';dbname=' . $db, $user, $password);
    $dbh = null;
}
catch (PDOException $e) {
    header("Location: step1.php?error=2"); //Redirect as server info is incorrectly fed
    exit;
}


//From where to import sql file
$dbms_schema = 'db/cms.sql';
$sql_query = @fread(@fopen($dbms_schema, 'r'), @filesize($dbms_schema)) or die('problem ');
$sql_query = remove_remarks($sql_query);
$sql_query = split_sql_file($sql_query, ';');


$i = 1;
foreach ($sql_query as $sql) {
    echo $i++;
    echo "
";
    $dbh = new PDO('mysql:host=' . $server . ';dbname=' . $db, $user, $password);
    $dbh->query($sql);
    $dbh = null;

}

//After successful import, it will create config file with all configs

$fp = fopen("../config.php", "w");
$savestring = "<?php\n\$server = \"" . $server . "\";\n\$user = \"" . $user . "\";\n\$password = \"" .
    $password . "\";\n\$db = \"" . $db . "\";\n?>";
fwrite($fp, $savestring);
fclose($fp);
//End of config file update


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
          <h1>Site Configuration:</h1>
        </div>
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
        <p class="text-muted credit">Fork our code at <a href="https://github.com/eanurag/anuku">GitHub</a></p>
      </div>
    </div>
  </body>
</html>