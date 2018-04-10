<?php
// include config file to connect to db
include_once('config.php');

// get id from URL
$id = $_GET['id'];

// delete data from database
$result = mysqli_query($mysqli, "DELETE FROM property WHERE id=$id");

// redirect to home page
header("location:index.php");

?>
