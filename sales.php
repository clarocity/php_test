<?php
// include config file to connect to db
include_once("config.php");

// get property id from URL
$id = $_GET['id'];

// fetch data of sales for that id
$sales_result = mysqli_query($mysqli, "SELECT a.id, a.sales_date, a.sales_price FROM sales a JOIN property b ON a.property_id = b.id WHERE a.property_id = $id");

$result = mysqli_query($mysqli, "SELECT * FROM property WHERE id=$id");
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Sales for this Property</title>
  </head>

  <body>
    <a href="index.php">Home</a>
    <h1>Sales for</h1>
      <?php
        while ($res = mysqli_fetch_array($result)) {
          echo $res["address"]."<br>";
          echo $res["city"];
        }
      ?>
    <table>
      <?php
        while ($sales_res = mysqli_fetch_array($sales_result)) {
          echo "<tr>";
          // echo "<td>Id: ".$sales_res["id"]."</td>";
          echo "<td>Date: ".$sales_res["sales_date"]."</td>";
          echo "<td>Price: ".$sales_res["sales_price"]."</td>";
          echo "<td>

                <a href=\"sales_update.php?id=$sales_res[id]\">Edit</a> |
                <a href=\"sales_delete.php?id=$sales_res[id]\">Delete</a>
                </td>";
        }
      ?>
    </table>






  </body>

</html>
