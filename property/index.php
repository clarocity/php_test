<?php include '../autoload.php';?>
<?php include '../layout/header.php';?>

    <ul class="breadcrumb">
        <li><a href="/">Home</a></li>
        <li class="active">All Properties</li>
    </ul>

    <p><a href="add.php" title="Edit Property" class="btn btn-primary btn-lg active" role="button"><i class="fa fa-plus fa-fw" style="color: #ffffff;"></i> Add Property</a></p>

    <!-- Could Improve -->
    <?php if (isset($_GET['deleted'])) { ?><div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Property Deleted</strong></div><?php } ?>

    <table class="table table-striped table-hover ">
        <thead>
        <tr>
            <th width="20">ID</th>
            <th>Address</th>
            <th>City</th>
            <th>State</th>
            <th>Zip</th>
            <th>Sale Count</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php
        $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
        $results = Properties::get_properties($page);
            foreach ($results['results'] as $row) {
                echo '<tr>';
                echo '<td>'.$row['id'].'</td>';
                echo '<td><a href="view.php?property_id='.$row['id'].'">'.$row['address'].'</a></td>';
                echo '<td>'.$row['city'].'</td>';
                echo '<td>'.$row['state'].'</td>';
                echo '<td>'.$row['zip'].'</td>';
                echo '<td>'.$row['sale_count'].'</td>';
                echo '<td width="60"><a href="modify.php?property_id='.$row['id'].'" title="Edit Property" class="btn btn-primary btn-lg active" role="button"><i class="fa fa-pencil fa-fw" style="color: #ffffff;"></i></a></td>';
                echo '</tr>';
            }
        ?>
        </tbody>
    </table>

    <h5><?php echo $results['ttl_props'];?> Properties</h5>
    <ul class="pagination" style="margin: 0px;">
        <?php
            for ($i = 1; $i <= $results['ttl_pages']; $i++) {
            echo '<li '.(($page==$i)?'class="active"':"").'><a href="?page='.$i.'">'.$i.'</a></li>';
        }
        ?>
    </ul>

<?php include '../layout/footer.php';?>