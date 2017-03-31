<?php
include $_SERVER["DOCUMENT_ROOT"].'/autoload.php';

// Could Move to OOP side...
if ($_POST) {
    $property = new Property($_POST);
    $property_id = $property->insert();
    header('Location: /property/view.php?property_id='.$property_id.'&added=true');
    exit;
}
?>
<?php include '../layout/header.php';?>

    <!-- Validation Rules -->
    <script src="/js/validate/property.js"></script>

    <ul class="breadcrumb">
        <li><a href="/">Home</a></li>
        <li><a href="/property">All Properties</a></li>
        <li class="active">Add Property</li>
    </ul>

<?php if ($_POST['id']) { ?><div class="alert alert-dismissible alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Property Added!</strong></div><?php } ?>

    <form class="form-horizontal" method="post" action="add.php">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['token']; ?>">
        <input type="hidden" name="token" value="<?php echo hash_hmac('sha256', '/add.php', $_SESSION['second_token']); ?>" />
        <fieldset>
            <legend>Add Property</legend>
            <div class="form-group">
                <label for="address" class="col-lg-2 control-label">Address</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="address" name="address" placeholder="Address">
                </div>
            </div>

            <div class="form-group">
                <label for="city" class="col-lg-2 control-label">City</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="city" name="city" placeholder="City">
                </div>
            </div>

            <div class="form-group">
                <label for="state" class="col-lg-2 control-label">State</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="state" name="state" placeholder="State">
                </div>
            </div>

            <div class="form-group">
                <label for="zip" class="col-lg-2 control-label">Zip</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="zip" name="zip" placeholder="Zip">
                </div>
            </div>

            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </fieldset>
    </form>
<?php include '../layout/footer.php';?>