<?php include '../autoload.php';?>
<?php include '../layout/header.php';?>

    <ul class="breadcrumb">
        <li><a href="/">Home</a></li>
        <li class="active">All Properties</li>
    </ul>

    <p><a href="add.php" title="Edit Property" class="btn btn-primary btn-lg active" role="button"><i class="fa fa-plus fa-fw" style="color: #ffffff;"></i> Add Property</a></p>

    <?php if (isset($_GET['added'])) { ?><div class="alert alert-dismissible alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Property Inserted</strong></div><?php } ?>
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
            foreach ($properties->get_properties() as $row) {
                echo '<tr>';
                echo '<td>'.$row->id.'</td>';
                echo '<td><a href="view.php?id='.$row->id.'">'.$row->address.'</a></td>';
                echo '<td>'.$row->city.'</td>';
                echo '<td>'.$row->state.'</td>';
                echo '<td>'.$row->zip.'</td>';
                echo '<td>'.$row->sale_count.'</td>';
                echo '<td width="120"><a href="modify.php?id='.$row->id.'" title="Edit Property" class="btn btn-primary btn-lg active" role="button"><i class="fa fa-pencil fa-fw" style="color: #ffffff;"></i></a> <a href="modify.php?action=delete&id='.$row->id.'"  title="Delete Property" class="btn btn-primary btn-lg active" role="button"><i class="fa fa-trash" style="color: #ffffff;"></i></a></td>';
                echo '</tr>';
            }
        ?>
        </tbody>
    </table>
<?php include '../layout/footer.php';?>