<?php
if ($_SERVER['SERVER_NAME'] == 'localhost'){
    require_once "dbprivate.php";
    $db = new PDO($dsn, $user, $pass);
} else {
    $dsn = "mysql:host=".getenv('CLEARDB_HOST').";dbname=".getenv('CLEARDB_DBNAME');
    $db = new PDO($dsn, getenv('CLEARDB_USER'), getenv('CLEARDB_PASS'));
}
?>

