<?php
  include_once("config.php");

  $id = $_GET['id'];

  $sales_result = mysqli_query($mysqli, "SELECT a.id, a.sales_date, a.sales_price FROM sales a JOIN property b ON a.property_id = b.id WHERE a.property_id = $id");

  $result = mysqli_query($mysqli, "SELECT * FROM property WHERE id=$id");
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Sales for this Property</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>

  <body>

    <div class="container">

      <div class="row">
        <h1 class="text-center">All Sales for Property</h1>

        <nav class="navbar navbar-default">
          <div class="container">
            <p class="navbar-btn">
              <a href="index.php" class="btn btn-primary">Home</a>
            </p>
          </div>
        </nav>
      </div>

      <h2>Sales for</h2>
        <?php
          while ($res = mysqli_fetch_array($result)) {
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
          while ($sales_res = mysqli_fetch_array($sales_result)) {
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
