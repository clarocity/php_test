<?php
  include_once("./../server/methods.php");

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
    <link rel="stylesheet" href="./../css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
            echo "<td>$".$sales_res["sales_price"]."</td>";
            echo "<td class=\"text-center\"><a role=\"button\" class=\"btn btn-info\" href=\"sales_update.php?id=$sales_res[id]\">Edit</a></td>
                <td class=\"text-center\">
                  <div>
                    <button type=\"button\" class=\"btn btn-danger\" data-href=\"sales_delete.php?id=$sales_res[id]\" data-toggle=\"modal\" data-target=\"#confirm-delete\">Delete</button>

                    <div class=\"modal fade\" id=\"confirm-delete\" tabindex=\"=1\" aria-hidden=\"true\" aria-labelledby=\"#confirm-delete\" role=\"dialog\">
                      <div class=\"modal-dialog\">
                        <div class=\"modal-content\">
                          <div class=\"modal-header\">
                            <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                            <h4>Are you sure?</h4>
                          </div>
                          <div class=\"modal-body\">
                            <p>Are you sure you want to delete this sale?</p>
                          </div>
                          <div class=\"modal-footer\">
                            <a class=\"btn btn-danger btn-ok\">Delete</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                </td>";
          }
        ?>

      </table>

    </div>
    <script>
      $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
      });
    </script>


  </body>
</html>
