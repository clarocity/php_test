<?php
include $_SERVER["DOCUMENT_ROOT"].'/autoload.php';

if ($_POST) {
    $property = new Property($db, $_POST);
    $property->modify();
} elseif ($_GET['action'] == 'delete') {
    $property = new Property($db, $_GET);
    $property->delete();
    header('Location: /property?deleted=true');
    exit;
} else {
    $property = new Property($db, $_GET);
    $property->get_property();
}


?>
<?php include '../layout/header.php';?>

    <ul class="breadcrumb">
        <li><a href="/">Home</a></li>
        <li><a href="/property">All Properties</a></li>
        <li class="active">Modify Property</li>
    </ul>

    <?php if ($_POST['id']) { ?><div class="alert alert-dismissible alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Property Modified!</strong></div><?php } ?>

    <form class="form-horizontal" method="post" action="modify.php?id=<?php echo $property->get_id();?>">
        <input type="hidden" name="id" value="<?php echo $property->get_id();?>">
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
                    <a href="/property/view.php?id=<?php echo $property->get_id();?>"><button type="button" class="btn btn-primary">View Property</button></a>
                </div>
            </div>
        </fieldset>
    </form>
<?php include '../layout/footer.php';?>