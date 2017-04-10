<?php
    $dsn = "mysql:host={getenv('CLEARDB_HOST')};dbname={getenv('CLEARDB_DBNAME')}";
    $db = new PDO($dsn, getenv('CLEARDB_USER'), getenv('CLEARDB_PASS'));
?>

