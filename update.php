<?php
  include_once("config.php");

  if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];

    if (empty($address) || empty($city) || empty($state) || empty($zip)) {
      echo "Please fill out all fields.";
    } else {
      $result = mysqli_query($mysqli, "UPDATE property SET address='$address', city='$city', state='$state', zip='$zip' WHERE id=$id");

      header("Location:index.php");
    }
  }
?>

<?php
  $id = $_GET['id'];

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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>

  <body>

    <div class="container">

      <div class="row">
        <h1 class="text-center">Update a Property</h1>
        <nav class="navbar navbar-default">
          <div class="container">
            <p class="navbar-btn">
              <a href="index.php" class="btn btn-primary">Home</a>
            </p>
          </div>
        </nav>
      </div>

      <h2>Update a Property</h2>
      <form action="update.php" method="post">
        <div class="form-group">
          <label for="address">Address:</label>
          <input type="text" class="form-control" name="address" id="address" value="<?php echo $address;?>">
        </div>
        <div class="form-group">
          <label for="city">City:</label>
          <input type="text" class="form-control" name="city" value="<?php echo $city;?>">
        </div>
        <div class="form-group">
          <label for="state">State:</label>
          <input type="text" class="form-control" name="state" value="<?php echo $state;?>">
        </div>
        <div class="form-group">
          <label for="zip">Zip:</label>
          <input type="text" class="form-control" name="zip" value="<?php echo $zip;?>">
        </div>
        <input type="hidden" name="id" value=<?php echo $_GET['id'];?>><br>
        <button type="submit" class="btn btn-default" name="update" value="Update">Submit

        </button>
      </form>

    </div>

  </body>
</html>
