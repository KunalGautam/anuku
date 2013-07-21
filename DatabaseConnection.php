<?php
include 'config.php';

class DBConnect {

	// Fucntion	-	Connect
	// Connects to the Database.
	function connect() {
		global $server, $password, $user, $db;
		$con = mysql_connect("$server", "$user", "$password");
		// // Testing
		// if ($con){
		// echo "Yay!\n";
		// }
		// // End Testing
		if (!$con) {
			echo('Could not connect to database: ' . mysql_error() . '<br/>');
		}

		mysql_set_charset('utf8', $con);

		$seldb = mysql_select_db($db);
		// // Testing
		// if ($seldb){
		// echo "Yay again\n";
		// }
		// // End Testing
		if (!$seldb) {
			echo('Could not connect to database: ' . mysql_error() . '<br/>');
		}
	}

	//Disconnect from the Database
	function disconnect() {
		mysql_close();
	}

	//Function to execute Database Queries
	function sqlQuery($qry) {
		$result = mysql_query($qry);
		return $result;
		// // Testing
		// if ($result){
		// echo "Yess!\n";
		// }
		// // End Testing
		if (!$result) {
			echo('Invalid query: ' . mysql_error() . '<br/>');
		}

	}

}
?>
