<?php include $_SERVER["DOCUMENT_ROOT"].'/autoload.php'; ?>
<?php include '../layout/header.php';?>
<?php
    if ($_POST) {
        new Sale($_POST);
    }
    else {
        $property_obj = new Property($_GET);
        $property_obj->get_property();
        $sales = $property_obj->get_property_sales();
    }
    ?>

    <!-- Validation Rules -->
    <script src="/js/validate/sales.js"></script>

    <ul class="breadcrumb">
        <li><a href="/">Home</a></li>
        <li><a href="/property">All Properties</a></li>
        <li class="active">View Property</li>
    </ul>

    <?php if (isset($_GET['added'])) { ?><div class="alert alert-dismissible alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Added Property ID: <?= $_GET['property_id']; ?></strong></div><?php } ?>

<?php if ($property_obj->isValid() == 1) { ?>
    <h2><?php echo $property_obj->get_address(); ?></h2>
    <h5><?php echo $property_obj->get_city(); ?>, <?php echo $property_obj->get_state(); ?> <?php echo $property_obj->get_zip(); ?></h5>

    <p>

    <form class="form-horizontal" method="post" action="modify.php">
        <a href="modify.php?property_id=<?php echo $property_obj->get_id();?>" title="Edit Property" class="btn btn-primary btn-lg" role="button"><i class="fa fa-pencil fa-fw" style="color: #ffffff;"></i></a>
        <input type="hidden" name="action" value="delete">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <input type="hidden" name="token" value="<?php echo hash_hmac('sha256', '/view.php', $_SESSION['csrf_second_token']); ?>" />
        <input type="hidden" name="property_id" value="<?=$_GET['property_id'];?>">
        <button type="submit" class="btn btn-danger btn-lg" title="Delete Property"><i class="fa fa-trash" style="color: #ffffff;"></i></button>
    </form>
    </p>
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
            if ($sales) {
                foreach ($sales as $row) {
                    echo '<tr><td>'.$row['sale_date'].'</td><td>$'.number_format($row['sale_price'],2).'</td></tr>';
                }
            } else {
                echo '<tr><td colspan="2">No sales records for this property.</td></tr>';
            }
        ?>
        </tbody>
    </table>

    <form class="form-horizontal" method="post" action="view.php?property_id=<?=$_GET['property_id'];?>" id="sales_form">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <input type="hidden" name="property_id" value="<?=$_GET['property_id'];?>">
        <input type="hidden" name="action" value="add">
        <fieldset>
            <legend>Add Sale</legend>
            <div class="form-group">
                <label for="address" class="col-lg-2 control-label"><strong>Sale Date</strong></label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="sale_date" name="sale_date" placeholder="Choose Date">
                </div>
            </div>

            <div class="form-group">
                <label for="city" class="col-lg-2 control-label"><strong>Sale Price</strong></label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="sale_price" name="sale_price" placeholder="Enter Price">
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <button type="submit" class="btn btn-primary">Add Sale</button>
                </div>
            </div>
        </fieldset>
    </form>

<?php } else { ?>
    <h2>No Record Found</h2>
<?php } ?>

<?php include '../layout/footer.php';?>