<?php
  include_once("./classes/methods.php");

  $id = $_GET["id"];

  $connection = new Methods();
  $read_join = $connection->read_join($id);
  $read_by_id = $connection->read_by_id($id, 'property');
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Sales for this Property</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>

  <body>

    <div class="container">

      <div class="row">
        <h1 class="text-center">All Sales for Property</h1>

        <nav class="navbar navbar-default" id="navcolor">
          <div class="container">
            <p class="navbar-btn">
              <a href="index.php" class="btn btn-primary pull-right">Home</a>
            </p>
          </div>
        </nav>
      </div>

      <h2>Sales for</h2>
        <?php
          while ($res = $read_by_id->fetch_array()) {
            echo "<h4>".$res["address"]."</h4>";
            echo "<h4>".$res["city"].", ".$res["state"].", ".$res["zip"]."</h4>";

          }
        ?>
      <table class="table table-striped table-bordered text-center">
        <tr>
          <td>Sales Date</td>
          <td>Sales Price</td>
          <td>Update Sale</td>
          <td>Delete Sale</td>
        </tr>

        <?php
          while ($sales_res = $read_join->fetch_array()) {
            echo "<tr>";
            // echo "<td>Id: ".$sales_res["id"]."</td>";
            echo "<td>".$sales_res["sales_date"]."</td>";
            echo "<td>".$sales_res["sales_price"]."</td>";
            echo "<td class=\"text-center\"><a role=\"button\" class=\"btn btn-info\" href=\"sales_update.php?id=$sales_res[id]\">Edit</a></td>
                <td class=\"text-center\"><a role=\"button\" class=\"btn btn-danger\" href=\"sales_delete.php?id=$sales_res[id]\">Delete</a>
                  </td>";
          }
        ?>
      </table>

    </div>

  </body>
</html>
