<?php
// connect with database
include_once('config.php');

// fetch data from database
// select all rows from property table, in descending order by id
$result = mysqli_query($mysqli, 'SELECT * FROM property ORDER BY id DESC');

?>


<!DOCTYPE html>
<html>
  <head>
    <title>Property Sales</title>
    <link rel="stylesheet" href="css/style.css">
  </head>

  <body>

    <h1>Property Sales</h1>


    <table>
      <!-- column headers -->
      <tr>
        <td>Address</td>
        <td>City</td>
        <td>State</td>
        <td>Zip</td>
        <td>Change</td>
      </tr>

      <!-- php file of data fetch -->
      <?php
        while ($res = mysqli_fetch_array($result)) {
          echo '<td>'.$res['address'].'</td>';
          echo '<td>'.$res['city'].'</td>';
          echo '<td>'.$res['state'].'</td>';
          echo '<td>'.$res['zip'].'</td>';
          echo '<td>
              <a href=\'update.php?id=$res[id]\'>Edit</a> | <a href=\'delete.php?id=$res[id]\'>Delete</a>
              </td>';
        }
      ?>

    </table>


    <!-- create a new property -->
    <a href="create.php">Add New Property</a>

  </body>

</html>
