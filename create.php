<!-- will generate a web form that can be used to insert records in the property table, display the HTML form and process the submitted form data and perform basic validation on user input before saving the data
-->
<?php
// include config file to connect to db
include_once("config.php");

if (isset($_POST["Submit"])) {
  $address = $_POST["address"];
  $city = $_POST["city"];
  $state = $_POST["state"];
  $zip = $_POST["zip"];

  // check that there aren't any empty fields
  if (empty($address) || empty($city) || empty($state) || empty($zip)) {
    echo "Please fill out all fields.";
  } else {
    $result = mysqli_query($mysqli, "INSERT INTO property (address, city, state, zip) VALUES ('$address', '$city', '$state', '$zip')");

    header("Location:index.php");
  }
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Add New Property</title>
  </head>
  <body>
    <a href="index.php">Home</a>
    <h2>Add a New Property</h2>
    <form action="create.php" method="post">
        Address: <input type="text" name="address"><br>
        City: <input type="text" name="city"><br>
        State: <input type="text" name="state"><br>
        Zip: <input type="text" name="zip"><br></br>
        <input type="submit" name="Submit" value="Submit">
    </form>
  </body>
</html>
