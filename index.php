<?php include 'autoload.php';?>
<?php include 'layout/header.php';?>

    <legend>Top Selling Properties</legend>
    <table class="table table-striped table-hover ">
        <thead>
        <tr>
            <th>Address</th>
            <th>City</th>
            <th>State</th>
            <th>Zip</th>
            <th>Sale Count</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach (Properties::get_top_selling() as $row) {
            echo '<tr>';
            echo '<td><a href="/property/view.php?property_id='.$row['id'].'">'.$row['address'].'</a></td>';
            echo '<td>'.$row['city'].'</td>';
            echo '<td>'.$row['state'].'</td>';
            echo '<td>'.$row['zip'].'</td>';
            echo '<td>'.$row['sale_count'].'</td>';
            echo '</tr>';
        }
        ?>
        </tbody>
    </table>

    <legend>Latest Property Sales</legend>
    <table class="table table-striped table-hover ">
        <thead>
        <tr>
            <th>Address</th>
            <th>City</th>
            <th>State</th>
            <th>Zip</th>
            <th>Sale Date</th>
            <th>Sale Price</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach (Properties::get_latest_sales() as $row) {
            echo '<tr>';
            echo '<td><a href="/property/view.php?property_id='.$row['id'].'">'.$row['address'].'</a></td>';
            echo '<td>'.$row['city'].'</td>';
            echo '<td>'.$row['state'].'</td>';
            echo '<td>'.$row['zip'].'</td>';
            echo '<td>'.$row['sale_date'].'</td>';
            echo '<td>$'.number_format($row['sale_price'],2).'</td>';
            echo '</tr>';
        }
        ?>
        </tbody>
    </table>

<?php include 'layout/footer.php';?>