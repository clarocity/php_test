<!-- will generate a web form that can be used to insert records in the property table, display the HTML form and process the submitted form data and perform basic validation on user input before saving the data
-->

<?php
// include config file to connect to db
include_once('config.php');

if (isset($_POST['submit'])) {
  $address = $_POST['address'];
  $city = $_POST('city');
  $state = $_POST('state');
  $zip = $_POST('zip');

  // check that there aren't any empty fields
  if (empty($address) || empty($city) || empty($state) || empty($zip)) {
    echo "Please fill out all fields.";
  } else {
    $result = mysqli_query($mysqli, "INSERT INTO property (address, city, state, zip) VALUES ('$address', '$city', '$state', '$zip')");

  echo "New property added";
  echo "<a href='index.php'>Return to homepage</a>";
  }


}
?>

<!DOCTYPE hmtl>
<html>
  <head>
    <title>Add New Property</title>
  </head>
  <body>
    <a href="index.php">Home</a>
    <h2>Add a New Property</h2>

    <form action='create.php' method="post">
      <tr>
        <td input name='address'>Address</td>
        <td input name='city'>City</td>
        <td input name='state'>State</td>
        <td input name='zip'>Zip</td>
        <td input type='submit'>Submit</td>
      </tr>
    </form>

  </body>

</html>
