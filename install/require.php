<?php
$score = 0;
 echo "<b>PHP Version Check</b><br />";
    if (strnatcmp(phpversion(),'5.3') >= 0) 
    { 
        echo 'Congratulations! You have Required php version. Your PHP version is ' . phpversion() .'<br \>'; 
		$score = $score+1;
    } 
    else 
    { 
       echo 'Sorry but your PHP version ' . phpversion() .' is below our requirement :( <br \>';
    } 
	
	
echo "<b>Folder Permission Check</b><br />";


$filename = '../config.php';
if (is_writable($filename)) {
    echo 'config file is writable';
	$score = $score+1;
} else {
    echo 'config file is not writable';
}


    




?>