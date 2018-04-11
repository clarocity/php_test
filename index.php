<?php
  include_once("./classes/methods.php");
  $connection = new Methods();
  $read = $connection->read();
  $result = $read->fetch_array();
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Property Sales</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>

  <body>

    <div class="container">

      <div class="row">
        <h1 class="text-center">Property Sales</h1>

        <nav class="navbar navbar-default">
          <div class="container">
              <p class="navbar-btn">
                <a href="create.php" class="btn btn-primary">Add New Property</a>
              </p>
          </div>
        </nav>
      </div>

      <table class="table table-striped table-bordered text-center">
        <tr>
          <td><strong>Address</strong></td>
          <td><strong>City</strong></td>
          <td><strong>State</strong></td>
          <td><strong>Zip</strong></td>
          <td><strong>Edit Property</strong></td>
          <td><strong>Delete Property<strong></td>
          <td><strong>Add New Sales</strong></td>
          <td><strong>View All Sales</strong></td>
        </tr>


        <?php
          while ($res = $read->fetch_array()) {
            echo "<tr>";
            echo "<td class=\"text-center\">".$res["address"]."</td>";
            echo "<td class=\"text-center\">".$res["city"]."</td>";
            echo "<td class=\"text-center\">".$res["state"]."</td>";
            echo "<td class=\"text-center\">".$res["zip"]."</td>";
            echo "<td class=\"text-center\"><a role=\"button\" class=\"btn btn-info\" href=\"update.php?id=$res[id]\">Edit Property</a></td>
                <td class=\"text-center\"><a role=\"button\" class=\"btn btn-danger\" href=\"delete.php?id=$res[id]\">Delete Property</a></td>
                <td class=\"text-center\"><a role=\"button\" class=\"btn btn-success\" href=\"sales_create.php?id=$res[id]\">New Sale</a></td>
                <td class=\"text-center\"><a role=\"button\" class=\"btn btn-primary\" href=\"sales.php?id=$res[id]\">All Sales</a></td>
                </td>";
          }
        ?>
      </table>

    </div>

  </body>
</html>
