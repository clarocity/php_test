<?php
  include_once("./classes/methods.php");

  $id = $_GET["id"];

  $connection = new Methods();
  $delete = $connection->delete($id, 'sales');

  header("Location:index.php");
?>
