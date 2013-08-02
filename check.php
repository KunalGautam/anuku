<?php
$filename = 'config.php';

if (file_exists($filename)) {
    include 'config.php';
} else {
    header("Location: install/");
    //exit();
}

if (!isset($server)) {
    $server = "";
}
if (!isset($user)) {
    $user = "";
}
if (!isset($password)) {
    $password = "";
}
if (!isset($db)) {
    $db = "";
}


function dbconnect($server, $user, $password, $db) {
$conn = @mysql_pconnect($server, $user, $password); // "@" is necessary.
if(!$conn) 
{
header("Location: install/");
//echo "kunal";
exit;
}
else{}
if(!mysql_select_db($db, $conn)) 
{
header("Location: install/");
exit;
}
}
?>