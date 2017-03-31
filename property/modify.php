<?php
include $_SERVER["DOCUMENT_ROOT"].'/autoload.php';

// Could Move to OOP side...
if ($_POST['action'] == 'delete') {
    $property = new Property($_POST);
    $property->delete();
    header('Location: /property?deleted=true');
    exit;
} else if ($_POST['action'] == 'modify') {
    $property = new Property($_POST);
    $property->modify();
} else {
    $property = new Property($_GET);
    $property->get_property();
}

?>
<?php include '../layout/header.php';?>

    <!-- Validation Rules -->
    <script src="/js/validate/property.js"></script>

    <ul class="breadcrumb">
        <li><a href="/">Home</a></li>
        <li><a href="/property">All Properties</a></li>
        <li class="active">Modify Property</li>
    </ul>

    <?php if ($_POST['property_id']) { ?><div class="alert alert-dismissible alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Property Modified!</strong> <br><a href="/property/view.php?property_id=<?php echo $property->get_id();?>"><button type="button" class="btn btn-success btn-xs">View Property</button></a></div><?php } ?>

    <form class="form-horizontal" method="post" action="modify.php?property_id=<?php echo $property->get_id();?>">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['token']; ?>">
        <input type="hidden" name="token" value="<?php echo hash_hmac('sha256', '/modify.php', $_SESSION['second_token']); ?>" />
        <input type="hidden" name="property_id" value="<?php echo $property->get_id();?>">
        <input type="hidden" name="action" value="modify">
        <fieldset>
            <legend>Edit Property</legend>
            <div class="form-group">
                <label for="address" class="col-lg-2 control-label">Address</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="<?php echo $property->get_address();?>" required>
                </div>
            </div>

            <div class="form-group">
                <label for="city" class="col-lg-2 control-label">City</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="city" name="city" placeholder="City" value="<?php echo $property->get_city();?>" required>
                </div>
            </div>

            <div class="form-group">
                <label for="state" class="col-lg-2 control-label">State</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="state" name="state" placeholder="State" value="<?php echo $property->get_state();?>" required>
                </div>
            </div>

            <div class="form-group">
                <label for="zip" class="col-lg-2 control-label">Zip</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="zip" name="zip" placeholder="Zip" value="<?php echo $property->get_zip();?>" required>
                </div>
            </div>

            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <button type="submit" class="btn btn-primary">Update Property</button>
                    <a href="/property/view.php?property_id=<?php echo $property->get_id();?>"><button type="button" class="btn btn-primary">View Property</button></a>
                </div>
            </div>
        </fieldset>
    </form>
<?php include '../layout/footer.php';?>