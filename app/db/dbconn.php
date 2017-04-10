<?php

try {
    require_once "dbprivate.php";
    $db = new PDO($dsn, $user, $pass);
} catch (Exception $e) {
    $error = $e->getMessage();
}

?>

