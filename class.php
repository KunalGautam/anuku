<?php
include ("config.php");


class dbconnect
{


function connect()
	{
		global $server, $password, $user, $db;
		$con = mysql_connect("$server","$user","$password");
		if (!$con)
	  		{
	  			echo('Could not connect to database: ' . mysql_error() . '<br>');
	  		}
mysql_set_charset('utf8',$con);

		$seldb = mysql_select_db($db);
		if (!$seldb)
			{
				echo('Could not connect to table: ' . mysql_error() . '<br>');
			}
	}

function disconnect()
	{
	mysql_close();
	}

function sqlquery($qry)
	{
	$result = mysql_query($query);
		if (!$result) 
			{  
			echo('Invalid query: ' . mysql_error()); 
			}

	}

//Rest class will be generated while working on CMS

}












?>
