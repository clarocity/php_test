<?php
include_once("config.php");

if (isset($_POST['update'])) {
  $id = $_POST['id'];
  $sales_date = $_POST['sales_date'];
  $sales_price = $_POST['sales_price'];

  if (empty($sales_date) || empty($sales_price)) {
    echo "Please fill out all fields.";
  } else {
    $result = mysqli_query($mysqli, "UPDATE sales SET sales_date='$sales_date', sales_price='$sales_price' WHERE id=$id");

    header("Location:index.php");
  }
}
?>

<?php
// get id from URL
$id = $_GET["id"];

$result = mysqli_query($mysqli, "SELECT * FROM sales WHERE id=$id");

while ($res = mysqli_fetch_array($result)) {
  $id = $res['id'];
  $sales_date = $res['sales_date'];
  $sales_price = $res['sales_price'];
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Update a Sale</title>
  </head>

  <body>
    <a href="index.php">Home</a>
    <h2>Update a Sale</h2>
    <form action="sales_update.php" method="post">
      Sales Date: <input type="text" name="sales_date" value="<?php echo $sales_date;?>"><br>
      Sales Price: <input type="text" name="sales_price" value="<?php echo $sales_price;?>"><br>
      <input type="hidden" name="id" value=<?php echo $_GET['id'];?>><br>
      <input type="submit" name="update" value="Update">
    </form>
  </body>


</html>
