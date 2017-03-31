<?php
include $_SERVER["DOCUMENT_ROOT"].'/autoload.php';

    // This could be moved into a controller...
    if ($_POST['action'] == 'add_sale') {
        $sale = new Sale($_POST);
        $sale->insert();
        header('Location: view.php?property_id='.$_POST['property_id']);
        exit;
    }

    $property = new Property($_GET);
    $property->get_property();
    $sales = new Sale($_GET);
    $property_sales = $sales->get_property_sales();
    ?>

<?php include '../layout/header.php';?>

    <!-- Validation Rules -->
    <script src="/js/validate/sales.js"></script>

    <ul class="breadcrumb">
        <li><a href="/">Home</a></li>
        <li><a href="/property">All Properties</a></li>
        <li class="active">View Property</li>
    </ul>

    <?php if (isset($_GET['added'])) { ?><div class="alert alert-dismissible alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Added Property ID: <?= $_GET['property_id']; ?></strong></div><?php } ?>

<?php if ($property->isValid() == 1) { ?>
    <h2><?php echo $property->get_address(); ?></h2>
    <h5><?php echo $property->get_city(); ?>, <?php echo $property->get_state(); ?> <?php echo $property->get_zip(); ?></h5>

    <p>

    <form class="form-horizontal" method="post" action="modify.php">
        <a href="modify.php?property_id=<?php echo $property->get_id();?>" title="Edit Property" class="btn btn-primary btn-lg" role="button"><i class="fa fa-pencil fa-fw" style="color: #ffffff;"></i></a>
        <input type="hidden" name="action" value="delete">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['token']; ?>">
        <input type="hidden" name="token" value="<?php echo hash_hmac('sha256', '/view.php', $_SESSION['second_token']); ?>" />
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
        if ($property_sales) {
            foreach ($property_sales as $row) {
                echo '<tr><td>'.$row['sale_date'].'</td><td>$'.number_format($row['sale_price'],2).'</td></tr>';
            }
        } else {
            echo '<tr><td colspan="2">No sales records for this property.</td></tr>';
        }
        ?>
        </tbody>
    </table>

    <form class="form-horizontal" method="post" action="view.php?property_id=<?=$_GET['property_id'];?>" id="sales_form">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['token']; ?>">
        <input type="hidden" name="property_id" value="<?=$_GET['property_id'];?>">
        <input type="hidden" name="action" value="add_sale">
        <fieldset>
            <legend>Add Sale</legend>
            <div class="form-group">
                <label for="address" class="col-lg-2 control-label">Sale Date</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="sale_date" name="sale_date" placeholder="Sale Date">
                </div>
            </div>

            <div class="form-group">
                <label for="city" class="col-lg-2 control-label">Sale Price</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="sale_price" name="sale_price" placeholder="Sale Price">
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