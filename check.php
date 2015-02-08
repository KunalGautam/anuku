<?php

// This block of code check if config file exsist or not. In case it exsist, include the file. If it doesn't exsist, redirect to installation folder
$filename = 'config.php';
if (file_exists($filename))
{
				include 'config.php';
} else
{
				header("Location: install/");
				exit;
}
// End of config file checking code
// This block of function check if details provided are correct or not, if any of the detail is not correct, it will generate mysql error, which will ultimately redirect to the install folder.
function dbconnect($server, $user, $password, $db)
{
	
	
	
	$dsn = 'mysql:dbname='.$db.';host='.$server;
try {
    $db = new PDO($dsn, $user, $password);
	$db = null; // Closing DB
    
    }
catch(PDOException $e)
    {
    echo "<h1>Error establishing database connection.</h1>";
    
    }
	
	
	
	
	
	
	
				
}
//End of DB connection checking block.
dbconnect($server, $user, $password, $db);

?>
