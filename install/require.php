<?php
$score = 0;
echo "<b>PHP Version Check</b><br />";
//PHP Version Check
if (strnatcmp(phpversion(), '5.3') >= 0) {
    echo 'Congratulations! You have Required php version. Your PHP version is ' .
        phpversion() . '<br \>';
    $score = $score + 1;
} else {
    echo 'Sorry but your PHP version ' . phpversion() .
        ' is below our requirement :( <br \>';
}
//End of PHP Version check
//File permission for config.php check, if it doesn't exsists, a new one will be created and then permission will be checked.
echo "<b>Folder Permission Check</b><br />";
$filename = '../config.php';
if (file_exists($filename)) {
    echo "The Config file exists<br/>";
} else {
    echo "The file config.php does not exist, it was created.<br/>";
    if (is_writable($filename)) {
        echo 'config file is writable';
        $score = $score + 1;
    } else {
        $fp = fopen("../config.php", "w");
        $content = "";
        fwrite($fp, $content);
        fclose($fp);
    }
}
if (is_writable($filename)) {
    echo 'config file is writable';
    $score = $score + 1;
} else {
    $fp = fopen("../config.php", "w");
    $content = "";
    fwrite($fp, $content);
    fclose($fp);
}
?>