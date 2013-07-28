<?php

session_start();

include '../DatabaseConnection.php';

if (!isset($_SESSION['logged_in'])) {

	header('Location:index.php');
	exit();

}

$id = $_GET['id'];

$dbobj = new DBConnect();

$dbobj -> connect();

$query = sprintf("delete from `data` where `id` = %d", $id);

$results = $dbobj -> sqlQuery($query);

if ($results) {

	$dbobj -> disconnect();
}

header('Location:index.php');
?>