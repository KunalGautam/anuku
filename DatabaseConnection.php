<?php
include ("config.php");

class DBConnect {

	// Fucntion	-	Connect
	// Connects to the Database. Takes $tb as an argument, which can either be the USER table or DATA table for now.
	function connect($tb) {
		global $server, $password, $user, $db;
		$con = mysql_connect("$server", "$user", "$password");
		if (!$con) {
			echo('Could not connect to database: ' . mysql_error() . '<br/>');
		}

		mysql_set_charset('utf8', $con);

		$seldb = mysql_select_db($tb);
		if (!$seldb) {
			echo('Could not connect to table: ' . mysql_error() . '<br/>');
		}
	}

	//Disconnect from the Database
	function disconnect() {
		mysql_close();
	}

	//Function to execute Database Queries
	function sqlQuery($qry) {
		$result = mysql_query($query);
		if (!$result) {
			echo('Invalid query: ' . mysql_error() . '<br/>');
		}

	}

}
?>
