<?php
  include_once("./../server/methods.php");
  $connection = new Methods();
  $read = $connection->read();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Property Sales</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./../css/style.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>

  <body>

    <div class="container">

      <div class="row">
        <h1 class="text-center">Property Sales</h1>

        <nav class="navbar navbar-default" id="navcolor">
          <div class="container">
              <p class="navbar-btn">
                <a href="create.php" class="btn btn-primary pull-right">Add New Property</a>
              </p>
          </div>
        </nav>
      </div>

      <table class="table table-striped table-bordered text-center">
        <tr id="notSelectable">
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
            echo "<td id=\"notSelectable\" class=\"text-center\">".$res["address"]."</td>";
            echo "<td class=\"text-center\">".$res["city"]."</td>";
            echo "<td class=\"text-center\">".$res["state"]."</td>";
            echo "<td class=\"text-center\">".$res["zip"]."</td>";
            echo "<td class=\"text-center\"><a role=\"button\" class=\"btn btn-info\" href=\"update.php?id=$res[id]\">Edit Property</a></td>

              <td class=\"text-center\"><div>
                <button type=\"button\" class=\"btn btn-danger\" data-href=\"delete.php?id=$res[id]\" data-toggle=\"modal\" data-target=\"#confirm-delete\">Delete Property</button>

                <div class=\"modal fade\" id=\"confirm-delete\" tabindex=\"=1\" aria-hidden=\"true\" aria-labelledby=\"#confirm-delete\" role=\"dialog\">
                  <div class=\"modal-dialog\">
                    <div class=\"modal-content\">
                      <div class=\"modal-header\">
                        <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                        <h4>Are you sure?</h4>
                      </div>
                      <div class=\"modal-body\">
                        <p>Are you sure you want to delete this property?</p>
                      </div>
                      <div class=\"modal-footer\">
                        <a class=\"btn btn-danger btn-ok\">Delete</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              </td>


              <td class=\"text-center\"><a role=\"button\" class=\"btn btn-success\" href=\"sales_create.php?id=$res[id]\">New Sale</a></td>
              <td class=\"text-center\"><a role=\"button\" class=\"btn btn-primary\" href=\"sales.php?id=$res[id]\">All Sales</a></td>
              </td>
              </tr>";
          }
        ?>
      </table>

    </div>
    <script>
      $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
      });
    </script>
    <script type="text/javascript">
      document.getElementById("notSelectable").onclick = function() {
        alert('Click on one of the button to edit!')
      }
    </script>

  </body>
</html>
