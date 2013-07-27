<?php

include '../DatabaseConnection.php';

$dbobj = new DBConnect();

$dbobj -> connect();

$query = sprint("delete from `data` where `id` = %d",$id);

$results = $dbobj -> sqlQuery($query);
?>
