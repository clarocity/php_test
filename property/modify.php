<?php include $_SERVER["DOCUMENT_ROOT"].'/autoload.php'; ?>
<?php if ($_POST) new Property($_POST); ?>
<?php
    $property = new Property($_GET);
    $property->get_property();
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
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <input type="hidden" name="token" value="<?php echo hash_hmac('sha256', '/modify.php', $_SESSION['csrf_second_token']); ?>" />
        <input type="hidden" name="property_id" value="<?php echo $property->get_id();?>">
        <input type="hidden" name="action" value="modify">
        <fieldset>
            <legend>Edit Property</legend>
            <div class="form-group">
                <label for="address" class="col-lg-2 control-label"><strong>Address</strong></label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="<?php echo $property->get_address();?>" required>
                </div>
            </div>

            <div class="form-group">
                <label for="city" class="col-lg-2 control-label"><strong>City</strong></label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="city" name="city" placeholder="City" value="<?php echo $property->get_city();?>" required>
                </div>
            </div>

            <div class="form-group">
                <label for="state" class="col-lg-2 control-label"><strong>State</strong></label>
                <div class="col-lg-10">
                    <select class="form-control" name="state" id="state">
                        <option value="">Select Sate</option>
                        <option value="AL" <?php echo (($property->get_state() == 'AL') ? 'selected' : '') ?>>Alabama</option>
                        <option value="AK" <?php echo (($property->get_state() == 'AK') ? 'selected' : '') ?>>Alaska</option>
                        <option value="AZ" <?php echo (($property->get_state() == 'AZ') ? 'selected' : '') ?>>Arizona</option>
                        <option value="AR" <?php echo (($property->get_state() == 'AR') ? 'selected' : '') ?>>Arkansas</option>
                        <option value="CA" <?php echo (($property->get_state() == 'CA') ? 'selected' : '') ?>>California</option>
                        <option value="CO" <?php echo (($property->get_state() == 'CO') ? 'selected' : '') ?>>Colorado</option>
                        <option value="CT" <?php echo (($property->get_state() == 'CT') ? 'selected' : '') ?>>Connecticut</option>
                        <option value="DE" <?php echo (($property->get_state() == 'DE') ? 'selected' : '') ?>>Delaware</option>
                        <option value="DC" <?php echo (($property->get_state() == 'DC') ? 'selected' : '') ?>>District of Columbia</option>
                        <option value="FL" <?php echo (($property->get_state() == 'FL') ? 'selected' : '') ?>>Florida</option>
                        <option value="GA" <?php echo (($property->get_state() == 'GA') ? 'selected' : '') ?>>Georgia</option>
                        <option value="HI" <?php echo (($property->get_state() == 'HI') ? 'selected' : '') ?>>Hawaii</option>
                        <option value="ID" <?php echo (($property->get_state() == 'ID') ? 'selected' : '') ?>>Idaho</option>
                        <option value="IL" <?php echo (($property->get_state() == 'IL') ? 'selected' : '') ?>>Illinois</option>
                        <option value="IN" <?php echo (($property->get_state() == 'IN') ? 'selected' : '') ?>>Indiana</option>
                        <option value="IA" <?php echo (($property->get_state() == 'IA') ? 'selected' : '') ?>>Iowa</option>
                        <option value="KS" <?php echo (($property->get_state() == 'KS') ? 'selected' : '') ?>>Kansas</option>
                        <option value="KY" <?php echo (($property->get_state() == 'KY') ? 'selected' : '') ?>>Kentucky</option>
                        <option value="LA" <?php echo (($property->get_state() == 'LA') ? 'selected' : '') ?>>Louisiana</option>
                        <option value="ME" <?php echo (($property->get_state() == 'ME') ? 'selected' : '') ?>>Maine</option>
                        <option value="MD" <?php echo (($property->get_state() == 'MD') ? 'selected' : '') ?>>Maryland</option>
                        <option value="MA" <?php echo (($property->get_state() == 'MA') ? 'selected' : '') ?>>Massachusetts</option>
                        <option value="MI" <?php echo (($property->get_state() == 'MI') ? 'selected' : '') ?>>Michigan</option>
                        <option value="MN" <?php echo (($property->get_state() == 'MN') ? 'selected' : '') ?>>Minnesota</option>
                        <option value="MS" <?php echo (($property->get_state() == 'MS') ? 'selected' : '') ?>>Mississippi</option>
                        <option value="MO" <?php echo (($property->get_state() == 'MO') ? 'selected' : '') ?>>Missouri</option>
                        <option value="MT" <?php echo (($property->get_state() == 'MT') ? 'selected' : '') ?>>Montana</option>
                        <option value="NE" <?php echo (($property->get_state() == 'NE') ? 'selected' : '') ?>>Nebraska</option>
                        <option value="NV" <?php echo (($property->get_state() == 'NV') ? 'selected' : '') ?>>Nevada</option>
                        <option value="NH" <?php echo (($property->get_state() == 'NH') ? 'selected' : '') ?>>New Hampshire</option>
                        <option value="NJ" <?php echo (($property->get_state() == 'NJ') ? 'selected' : '') ?>>New Jersey</option>
                        <option value="NM" <?php echo (($property->get_state() == 'NM') ? 'selected' : '') ?>>New Mexico</option>
                        <option value="NY" <?php echo (($property->get_state() == 'NY') ? 'selected' : '') ?>>New York</option>
                        <option value="NC" <?php echo (($property->get_state() == 'NC') ? 'selected' : '') ?>>North Carolina</option>
                        <option value="ND" <?php echo (($property->get_state() == 'ND') ? 'selected' : '') ?>>North Dakota</option>
                        <option value="OH" <?php echo (($property->get_state() == 'OH') ? 'selected' : '') ?>>Ohio</option>
                        <option value="OK" <?php echo (($property->get_state() == 'OK') ? 'selected' : '') ?>>Oklahoma</option>
                        <option value="OR" <?php echo (($property->get_state() == 'OR') ? 'selected' : '') ?>>Oregon</option>
                        <option value="PA" <?php echo (($property->get_state() == 'PA') ? 'selected' : '') ?>>Pennsylvania</option>
                        <option value="RI" <?php echo (($property->get_state() == 'RI') ? 'selected' : '') ?>>Rhode Island</option>
                        <option value="SC" <?php echo (($property->get_state() == 'SC') ? 'selected' : '') ?>>South Carolina</option>
                        <option value="SD" <?php echo (($property->get_state() == 'SD') ? 'selected' : '') ?>>South Dakota</option>
                        <option value="TN" <?php echo (($property->get_state() == 'TN') ? 'selected' : '') ?>>Tennessee</option>
                        <option value="TX" <?php echo (($property->get_state() == 'TX') ? 'selected' : '') ?>>Texas</option>
                        <option value="UT" <?php echo (($property->get_state() == 'UT') ? 'selected' : '') ?>>Utah</option>
                        <option value="VT" <?php echo (($property->get_state() == 'VT') ? 'selected' : '') ?>>Vermont</option>
                        <option value="VA" <?php echo (($property->get_state() == 'VA') ? 'selected' : '') ?>>Virginia</option>
                        <option value="WA" <?php echo (($property->get_state() == 'WA') ? 'selected' : '') ?>>Washington</option>
                        <option value="WV" <?php echo (($property->get_state() == 'WV') ? 'selected' : '') ?>>West Virginia</option>
                        <option value="WI" <?php echo (($property->get_state() == 'WI') ? 'selected' : '') ?>>Wisconsin</option>
                        <option value="WY" <?php echo (($property->get_state() == 'WY') ? 'selected' : '') ?>>Wyoming</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="zip" class="col-lg-2 control-label"><strong>Zip</strong></label>
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