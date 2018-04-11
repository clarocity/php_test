<?php
include_once("config.php");

if (isset($_POST["Submit"])) {
  $property_id = $_POST["property_id"];
  $sales_date = $_POST["sales_date"];
  $sales_price = $_POST["sales_price"];

  if (empty($property_id) || empty($sales_date) || empty($sales_price)) {
    echo "<font>Please fill out all fields.</font>";
  } else {
    $result = mysqli_query($mysqli, "INSERT INTO sales (property_id, sales_date, sales_price) VALUES ('$property_id', '$sales_date', '$sales_price')");
  }
  header("Location:index.php");
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Add New Sale</title>
  </head>

  <body>
    <a href="index.php">Home</a>
    <h2>Add a New Sale</h2>
    <form action="sales_create.php" method="post">
      <input type="text" name="property_id" value=<?php echo $_GET['id'];?>><br>
      Sales Date: <input type="text" name="sales_date"><br>
      Sales Price: <input type="text" name="sales_price"><br>
      <input type="submit" name="Submit" value="Submit">
    </form>
  </body>

</html>
