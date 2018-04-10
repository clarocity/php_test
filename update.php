<?php
// include config file to connect to db
include_once('config.php');

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
  }

}

?>

<!--  HTML displayed with existing data -->

<?php
// get id from URL
$id = $_GET['id'];

// return data for that id
$result = mysqli_query($mysqli, "SELECT * FROM property WHERE id=$id");

while ($res = mysqli_fetch_array($result)) {
  $address = $res['address'];
  $city = $res['city'];
  $state = $res['state'];
  $zip = $res['zip'];
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Edit Property</title>
  </head>
  <body>
    <a href="index.php">Home</a>
    <form action="update.php" method="post">
      <table>
        <tr>
          <td input type="text" name="address" value="<?php echo $address; ?>"</td>
          <td input type="text" name="city" value="<?php echo $city; ?>"</td>
          <td input type="text" name="state" value="<?php echo $state; ?>"</td>
          <td input type="text" name="zip" value="<?php echo $zip; ?>"</td>
          <td input type="text" name="id" value=<?php echo $_GET['id']; ?>></td>
          <td input type="submit" name="update">Update</td>
        </tr>
      </table>
    </form>


  </body>

</html>
