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
// This block or set of if condition if that file contain the variables or not, if it is not defined, it will assign those variables as blank, so that it goes to next function
if (!isset($server))
{
				$server = "";
}
if (!isset($user))
{
				$user = "";
}
if (!isset($password))
{
				$password = "";
}
if (!isset($db))
{
				$db = "";
}
//End of if Block for assigning variables if not available in config file
// This block of function check if details provided are correct or not, if any of the detail is not correct, it will generate mysql error, which will ultimately redirect to the install folder.
function dbconnect($server, $user, $password, $db)
{
				$conn = @mysql_pconnect($server, $user, $password); // "@" is necessary.
				if (!$conn)
				{
								header("Location: install/");
								exit;
				} else
				{
								/*though this is not needed, it is just placeholder if something pop up in mind of developer :P */
				}
				if (!mysql_select_db($db, $conn))
				{
								header("Location: install/");
								exit;
				}
}
//End of DB connection checking block.


?>