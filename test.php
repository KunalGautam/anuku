<?php


$dsn = 'mysql:dbname='.$_POST['db'].';host='.$_POST['server'];



try {
    $db = new PDO($dsn, $_POST['user'], $_POST['password']);
    $sql = file_get_contents('db/cms.sql');
    $qr = $db->exec($sql);
    
    }
catch(PDOException $e)
    {
    echo $e->getMessage();
    }

//

//

?>
