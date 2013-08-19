<?php
// This block of code check if config file exsist or not. In case it exsist, include the file. If it doesn't exsist, redirect to installation folder
$filename = 'config.php';
if (file_exists($filename)) {
    include 'config.php';
} else {
    header("Location: install/");
    exit;
}
// End of config file checking code
// This block or set of if condition if that file contain the variables or not, if it is not defined, it will assign those variables as blank, so that it goes to next function
if (!isset($server)) {
    $server = "localhost";
}
if (!isset($user)) {
    $user = " ";
}
if (!isset($password)) {
    $password = " ";
}
if (!isset($db)) {
    $db = " ";
}
//Check if Host is alive or not.
try {
    $dbh = new PDO('mysql:host=' . $server);
    $dbh = null;
}
//If host is alive check if details in config file are ok or not
catch (PDOException $e) {
    print "Unable to connect to Database, Seems like your MySQL server is not reachable";
    die();
}
try {
    $dbh = new PDO('mysql:host=' . $server, $user, $password);
    $dbh = null;
}
catch (PDOException $e) {
    header("Location: install/");
    exit;
}
try {
    $dbh = new PDO('mysql:host=' . $server . ';dbname=' . $db, $user, $password);
    $dbh = null;
}
catch (PDOException $e) {
    header("Location: install/");
    exit;
}
?>
