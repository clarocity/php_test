<?php include $_SERVER["DOCUMENT_ROOT"].'/autoload.php'; ?>
<?php include $_SERVER["DOCUMENT_ROOT"].'/layout/header.php';?>

<?php if ($_POST) new Property($_POST); ?>

    <!-- Validation Rules -->
    <script src="/js/validate/property.js"></script>

    <ul class="breadcrumb">
        <li><a href="/">Home</a></li>
        <li><a href="/property">All Properties</a></li>
        <li class="active">Add Property</li>
    </ul>

<?php if ($_POST['id']) { ?><div class="alert alert-dismissible alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Property Added!</strong></div><?php } ?>

    <form class="form-horizontal" method="post" action="add.php">
        <input type="hidden" name="action" value="add">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['token']; ?>">
        <input type="hidden" name="token" value="<?php echo hash_hmac('sha256', '/add.php', $_SESSION['second_token']); ?>" />
        <fieldset>
            <legend>Add Property</legend>
            <div class="form-group">
                <label for="address" class="col-lg-2 control-label"><strong>Address</strong></label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="address" name="address" placeholder="">
                </div>
            </div>

            <div class="form-group">
                <label for="city" class="col-lg-2 control-label"><strong>City</strong></label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="city" name="city" placeholder="">
                </div>
            </div>

            <div class="form-group">
                <label for="state" class="col-lg-2 control-label"><strong>State</strong></label>
                <div class="col-lg-10">
                    <select class="form-control" name="state" id="state">
                        <option value="">Select Sate</option>
                        <option value="AL">Alabama</option>
                        <option value="AK">Alaska</option>
                        <option value="AZ">Arizona</option>
                        <option value="AR">Arkansas</option>
                        <option value="CA">California</option>
                        <option value="CO">Colorado</option>
                        <option value="CT">Connecticut</option>
                        <option value="DE">Delaware</option>
                        <option value="DC">District Of Columbia</option>
                        <option value="FL">Florida</option>
                        <option value="GA">Georgia</option>
                        <option value="HI">Hawaii</option>
                        <option value="ID">Idaho</option>
                        <option value="IL">Illinois</option>
                        <option value="IN">Indiana</option>
                        <option value="IA">Iowa</option>
                        <option value="KS">Kansas</option>
                        <option value="KY">Kentucky</option>
                        <option value="LA">Louisiana</option>
                        <option value="ME">Maine</option>
                        <option value="MD">Maryland</option>
                        <option value="MA">Massachusetts</option>
                        <option value="MI">Michigan</option>
                        <option value="MN">Minnesota</option>
                        <option value="MS">Mississippi</option>
                        <option value="MO">Missouri</option>
                        <option value="MT">Montana</option>
                        <option value="NE">Nebraska</option>
                        <option value="NV">Nevada</option>
                        <option value="NH">New Hampshire</option>
                        <option value="NJ">New Jersey</option>
                        <option value="NM">New Mexico</option>
                        <option value="NY">New York</option>
                        <option value="NC">North Carolina</option>
                        <option value="ND">North Dakota</option>
                        <option value="OH">Ohio</option>
                        <option value="OK">Oklahoma</option>
                        <option value="OR">Oregon</option>
                        <option value="PA">Pennsylvania</option>
                        <option value="RI">Rhode Island</option>
                        <option value="SC">South Carolina</option>
                        <option value="SD">South Dakota</option>
                        <option value="TN">Tennessee</option>
                        <option value="TX">Texas</option>
                        <option value="UT">Utah</option>
                        <option value="VT">Vermont</option>
                        <option value="VA">Virginia</option>
                        <option value="WA">Washington</option>
                        <option value="WV">West Virginia</option>
                        <option value="WI">Wisconsin</option>
                        <option value="WY">Wyoming</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="zip" class="col-lg-2 control-label"><strong>Zip</strong></label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="zip" name="zip" placeholder="">
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