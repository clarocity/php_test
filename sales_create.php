<?php
  include_once("./classes/methods.php");

  if (isset($_POST["Submit"])) {
    $property_id = $_POST["property_id"];
    $sales_date = $_POST["sales_date"];
    $sales_price = $_POST["sales_price"];

    if (empty($property_id) || empty($sales_date) || empty($sales_price)) {
      echo "Please fill out all fields.";
    } else {
      $connection = new Methods();
      $connection->sales_create($property_id, $sales_date, $sales_price);
      header("Location:index.php");
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Add New Sale</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>

  <body>
    <div class="container">

      <div class="row">
        <h1 class="text-center">Add a New Sale</h1>

        <nav class="navbar navbar-default">
          <div class="container">
            <p class="navbar-btn">
              <a href="index.php" class="btn btn-primary">Home</a>
            </p>
          </div>
        </nav>
      </div>

      <h2>Add a New Sale</h2>
      <form action="sales_create.php" method="post">
        <div class="form-group">
          <label for="sales_date">Sales Date:</label>
          <input type="text" class="form-control" id="sales_date" name="sales_date">
        </div>
        <div class="form-group">
          <label for="sales_price">Sales Price:</label>
          <input type="text" class="form-control" id="sales_price" name="sales_price">
        </div>
        <input type="hidden" name="property_id" value=<?php echo $_GET['id'];?>>
        <button type="submit" class="btn btn-default" name="Submit" value="Submit">Submit</button>
      </form>

    </div>
  </body>

</html>
