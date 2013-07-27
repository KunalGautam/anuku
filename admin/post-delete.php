<?php

include '../DatabaseConnection.php';
$id = $_GET['id'];
$dbobj = new DBConnect();

$dbobj -> connect();

$query = sprintf("delete from `data` where `id` = %d",$id);

$results = $dbobj -> sqlQuery($query);
header('Location:index.php');
?>