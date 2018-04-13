<?php
  include_once("./../server/methods.php");

  if (isset($_POST["update"])) {
    $id = $_POST["id"];
    $sales_date = $_POST["sales_date"];
    $sales_price = $_POST["sales_price"];

    if (empty($id) || empty($sales_date) || empty($sales_price)) {
      echo "Please fill out all fields.";
    } else {
      $connection = new Methods();
      $connection->sales_update($id, $sales_date, $sales_price);
      header("Location:index.php");
    }
  }
?>

<?php
  $id = $_GET["id"];

  $connection = new Methods();
  $read_by_id = $connection->read_by_id($id, 'sales');

  while ($res = $read_by_id->fetch_array()) {
    $id = $res["id"];
    $sales_date = $res["sales_date"];
    $sales_price = $res["sales_price"];
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Update a Sale</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./../css/style.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>

  <body>

    <div class="container">

      <div class="row">
        <h1 class="text-center">Update Sale</h1>

        <nav class="navbar navbar-default" id="navcolor">
          <div class="container">
            <p class="navbar-btn">
              <a href="index.php" class="btn btn-primary pull-right">Home</a>
            </p>
          </div>
        </nav>
      </div>

      <h2>Update a Sale</h2>
      <form action="sales_update.php" method="post">
        <div class="form-group">
          <label for="sales_date">Sales Date:</label>
          <input type="text" class="form-control" id="sales_date" name="sales_date" value="<?php echo $sales_date;?>">
        </div>
        <div class="form-group">
          <label for="sales_price">Sales Price:</label>
          <input type="text" class="form-control" id="sales_date" name="sales_price" value="<?php echo $sales_price;?>">
        </div>
        <input type="hidden" name="id" value=<?php echo $_GET['id'];?>>
        <button type="submit" class="btn btn-default" name="update" value="Update">Update</button>
      </form>

    </div>

  </body>
</html>
