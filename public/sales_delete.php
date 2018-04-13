<?php
  include_once("./../server/methods.php");

  $id = $_GET["id"];

  $connection = new Methods();
  $delete = $connection->delete($id, 'sales');

  header("Location:index.php");
?>
