<?php
// include config file to connect to db
include_once("config.php");

if (isset($_POST['update'])) {
  $id = $_POST['id'];
  $address = $_POST['address'];
  $city = $_POST['city'];
  $state = $_POST['state'];
  $zip = $_POST['zip'];

  // check that there aren't any empty fields
  if (empty($address) || empty($city) || empty($state) || empty($zip)) {
    echo "Please fill out all fields.";
  } else {
    $result = mysqli_query($mysqli, "UPDATE property SET address='$address', city='$city', state='$state', zip='$zip' WHERE id=$id");

    header("Location:index.php");
  }
}
?>

<!--  HTML displayed with existing data -->

<?php
// get id from URL
$id = $_GET['id'];

// fetch data for that id
$result = mysqli_query($mysqli, "SELECT * FROM property WHERE id=$id");

while ($res = mysqli_fetch_array($result)) {
  $id = $res['id'];
  $address = $res['address'];
  $city = $res['city'];
  $state = $res['state'];
  $zip = $res['zip'];
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Update Property</title>
  </head>

  <body>
    <a href="index.php">Home</a>
    <h2>Update a Property</h2>
    <form action="update.php" method="post">
      Address: <input type="text" name="address" value="<?php echo $address;?>"><br>
      City: <input type="text" name="city" value="<?php echo $city;?>"><br>
      State: <input type="text" name="state" value="<?php echo $state;?>"><br>
      Zip: <input type="text" name="zip" value="<?php echo $zip;?>"><br>
      <input type="hidden" name="id" value=<?php echo $_GET['id'];?>><br>
      <input type="submit" name="update" value="Update">
    </form>
  </body>
</html>
