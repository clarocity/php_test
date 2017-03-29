<?php
include $_SERVER["DOCUMENT_ROOT"].'/autoload.php';

    if ($_POST) {
        $property = new Sale($db, $_POST);
        $property->insert();
    }

    $property = new Property($db, $_GET);
    $property->get_property();
    $sales = $property->get_property_sales();
    ?>

<?php include '../layout/header.php';?>

    <ul class="breadcrumb">
        <li><a href="/">Home</a></li>
        <li><a href="/property">All Properties</a></li>
        <li class="active">View Property</li>
    </ul>

    <h2><?php echo $property->get_address(); ?></h2>
    <h5><?php echo $property->get_city(); ?>, <?php echo $property->get_state(); ?> <?php echo $property->get_zip(); ?></h5>

    <p><a href="modify.php?id=<?php echo $property->get_id();?>" title="Edit Property" class="btn btn-primary btn-lg active" role="button"><i class="fa fa-pencil fa-fw" style="color: #ffffff;"></i> Edit Property</a></p>

    <table class="table table-striped table-hover " width="300">
        <thead>
        <tr>
            <th>Sale Date</th>
            <th>Sale Price</th>
        </tr>
        </thead>
        <tbody>
            <?php

            // Display sales for property
            foreach ($sales as $row) {
                echo '<tr><td>'.$row->sale_date.'</td><td>$'.number_format($row->sale_price,2).'</td></tr>';
            }

            // If no sales are found, display warning
            if (!$sales) {
                echo '<tr><td colspan="2">No sales records for this property.</td></tr>';
            }
            ?>
        </tbody>
    </table>

    <form class="form-horizontal" method="post" action="view.php?id=<?=$_GET['id'];?>">
        <input type="hidden" name="property_id" value="<?=$_GET['id'];?>">
        <fieldset>
            <legend>Add Sale</legend>
            <div class="form-group">
                <label for="address" class="col-lg-2 control-label">Sale Date</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="sale_date" name="sale_date" placeholder="Sale Date" required>
                </div>
            </div>

            <div class="form-group">
                <label for="city" class="col-lg-2 control-label">Sale Price</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="sale_price" name="sale_price" placeholder="Sale Price" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <button type="submit" class="btn btn-primary">Add Sale</button>
                </div>
            </div>
        </fieldset>
    </form>

<?php include '../layout/footer.php';?>