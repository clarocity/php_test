<?php
  include_once("./classes/methods.php");

  if (isset($_POST["Submit"])) {
    $address = $_POST["address"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $zip = $_POST["zip"];

    if (empty($address) || empty($city) || empty($state) || empty($zip)) {
      echo "Please fill out all fields.";
    } else {
      $connection = new Methods();
      $connection->create($address, $city, $state, $zip);
      header("Location:index.php");
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Add New Property</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>

  <body>

    <div class="container">

      <div class="row">
        <h1 class="text-center">Property Sales</h1>

        <nav class="navbar navbar-default" id="navcolor">
          <div class="container">
            <p class="navbar-btn">
              <a href="index.php" class="btn btn-primary pull-right">Home</a>
            </p>
          </div>
        </nav>
      </div>

      <h2>Add a New Property</h2>
      <form action="create.php" method="post">
        <div class="form-group">
          <label for="address">Address:</label>
          <input type="text" class="form-control" id="address" name="address">
        </div>
        <div class="form-group">
          <label for="city">City:</label>
          <input type="text" class="form-control" id="city" name="city">
        </div>
        <div class="form-group">
          <label for="state">State:</label>
          <input type="text" class="form-control" id="state" name="state">
        </div>
        <div class="form-group">
          <label for="zip">Zip:</label>
          <input type="text" class="form-control" id="zip" name="zip">
        </div>
          <button type="submit" class="btn btn-default" name="Submit" value="Submit">Submit</button>
        </div>
      </form>

    </div>

  </body>
</html>
