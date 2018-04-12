<?php
  include_once("./classes/methods.php");

  $id = $_GET["id"];

  $connection = new Methods ();
  $delete = $connection->delete($id, 'property');

  header("Location:index.php");
?>
