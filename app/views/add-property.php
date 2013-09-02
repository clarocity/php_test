<?php
if (isset($errors)) {
    echo '<div class="alert alert-danger">' . $errors . '</div>';
}
if (isset($recordId)) {
    echo '<div class="alert alert-info">Record updated successfully</div>';
}
?>
<form role="form" method="post">
    <div class="form-group <?php echo (isset($property) && !$property->isValid('address'))? 'has-error': ''; ?>">
        <label for="address">Address</label>
        <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address" value="<?php echo (isset($property) && $property->isValid('address'))? $property->address: ''; ?>">
    </div>
    <div class="form-group <?php echo (isset($property) && !$property->isValid('city'))? 'has-error': ''; ?>">
        <label for="city">City</label>
        <input type="text" class="form-control" id="city" name="city" placeholder="Enter City" value="<?php echo (isset($property) && $property->isValid('city'))? $property->city: ''; ?>">
    </div>
    <div class="form-group <?php echo (isset($property) && !$property->isValid('zip'))? 'has-error': ''; ?>">
        <label for="zip">ZIP Code</label>
        <input type="text" class="form-control" id="zip" name="zip" placeholder="Enter ZIP Code"  value="<?php echo (isset($property) && $property->isValid('zip'))? $property->zip: ''; ?>">
    </div>
    <div class="form-group <?php echo (isset($property) && !$property->isValid('state'))? 'has-error': ''; ?>">
        <label for="state">Select State</label>
        <select class="form-control" name="state" id="state">
            <option value="-1" disabled <?php echo ((!isset($property) || (isset($property) && '' == $property->state))? 'selected': '')?>>Select Sate</option>
            <option value="AL" <?php echo ((isset($property) && 'AL' == $property->state)? 'selected': '')?>>Alabama</option>
            <option value="AK" <?php echo ((isset($property) && 'AK' == $property->state)? 'selected': '')?>>Alaska</option>
            <option value="AZ" <?php echo ((isset($property) && 'AZ' == $property->state)? 'selected': '')?>>Arizona</option>
            <option value="AR" <?php echo ((isset($property) && 'AR' == $property->state)? 'selected': '')?>>Arkansas</option>
            <option value="CA" <?php echo ((isset($property) && 'CA' == $property->state)? 'selected': '')?>>California</option>
            <option value="CO" <?php echo ((isset($property) && 'CO' == $property->state)? 'selected': '')?>>Colorado</option>
            <option value="CT" <?php echo ((isset($property) && 'CT' == $property->state)? 'selected': '')?>>Connecticut</option>
            <option value="DE" <?php echo ((isset($property) && 'DE' == $property->state)? 'selected': '')?>>Delaware</option>
            <option value="DC" <?php echo ((isset($property) && 'DC' == $property->state)? 'selected': '')?>>District of Columbia</option>
            <option value="FL" <?php echo ((isset($property) && 'FL' == $property->state)? 'selected': '')?>>Florida</option>
            <option value="GA" <?php echo ((isset($property) && 'GA' == $property->state)? 'selected': '')?>>Georgia</option>
            <option value="HI" <?php echo ((isset($property) && 'HI' == $property->state)? 'selected': '')?>>Hawaii</option>
            <option value="ID" <?php echo ((isset($property) && 'ID' == $property->state)? 'selected': '')?>>Idaho</option>
            <option value="IL" <?php echo ((isset($property) && 'IL' == $property->state)? 'selected': '')?>>Illinois</option>
            <option value="IN" <?php echo ((isset($property) && 'IN' == $property->state)? 'selected': '')?>>Indiana</option>
            <option value="IA" <?php echo ((isset($property) && 'IA' == $property->state)? 'selected': '')?>>Iowa</option>
            <option value="KS" <?php echo ((isset($property) && 'KS' == $property->state)? 'selected': '')?>>Kansas</option>
            <option value="KY" <?php echo ((isset($property) && 'KY' == $property->state)? 'selected': '')?>>Kentucky</option>
            <option value="LA" <?php echo ((isset($property) && 'LA' == $property->state)? 'selected': '')?>>Louisiana</option>
            <option value="ME" <?php echo ((isset($property) && 'ME' == $property->state)? 'selected': '')?>>Maine</option>
            <option value="MD" <?php echo ((isset($property) && 'MD' == $property->state)? 'selected': '')?>>Maryland</option>
            <option value="MA" <?php echo ((isset($property) && 'MA' == $property->state)? 'selected': '')?>>Massachusetts</option>
            <option value="MI" <?php echo ((isset($property) && 'MI' == $property->state)? 'selected': '')?>>Michigan</option>
            <option value="MN" <?php echo ((isset($property) && 'MN' == $property->state)? 'selected': '')?>>Minnesota</option>
            <option value="MS" <?php echo ((isset($property) && 'MS' == $property->state)? 'selected': '')?>>Mississippi</option>
            <option value="MO" <?php echo ((isset($property) && 'MO' == $property->state)? 'selected': '')?>>Missouri</option>
            <option value="MT" <?php echo ((isset($property) && 'MT' == $property->state)? 'selected': '')?>>Montana</option>
            <option value="NE" <?php echo ((isset($property) && 'NE' == $property->state)? 'selected': '')?>>Nebraska</option>
            <option value="NV" <?php echo ((isset($property) && 'NV' == $property->state)? 'selected': '')?>>Nevada</option>
            <option value="NH" <?php echo ((isset($property) && 'NH' == $property->state)? 'selected': '')?>>New Hampshire</option>
            <option value="NJ" <?php echo ((isset($property) && 'NJ' == $property->state)? 'selected': '')?>>New Jersey</option>
            <option value="NM" <?php echo ((isset($property) && 'NM' == $property->state)? 'selected': '')?>>New Mexico</option>
            <option value="NY" <?php echo ((isset($property) && 'NY' == $property->state)? 'selected': '')?>>New York</option>
            <option value="NC" <?php echo ((isset($property) && 'NC' == $property->state)? 'selected': '')?>>North Carolina</option>
            <option value="ND" <?php echo ((isset($property) && 'ND' == $property->state)? 'selected': '')?>>North Dakota</option>
            <option value="OH" <?php echo ((isset($property) && 'OH' == $property->state)? 'selected': '')?>>Ohio</option>
            <option value="OK" <?php echo ((isset($property) && 'OK' == $property->state)? 'selected': '')?>>Oklahoma</option>
            <option value="OR" <?php echo ((isset($property) && 'OR' == $property->state)? 'selected': '')?>>Oregon</option>
            <option value="PA" <?php echo ((isset($property) && 'PA' == $property->state)? 'selected': '')?>>Pennsylvania</option>
            <option value="RI" <?php echo ((isset($property) && 'RI' == $property->state)? 'selected': '')?>>Rhode Island</option>
            <option value="SC" <?php echo ((isset($property) && 'SC' == $property->state)? 'selected': '')?>>South Carolina</option>
            <option value="SD" <?php echo ((isset($property) && 'SD' == $property->state)? 'selected': '')?>>South Dakota</option>
            <option value="TN" <?php echo ((isset($property) && 'TN' == $property->state)? 'selected': '')?>>Tennessee</option>
            <option value="TX" <?php echo ((isset($property) && 'TX' == $property->state)? 'selected': '')?>>Texas</option>
            <option value="UT" <?php echo ((isset($property) && 'UT' == $property->state)? 'selected': '')?>>Utah</option>
            <option value="VT" <?php echo ((isset($property) && 'VT' == $property->state)? 'selected': '')?>>Vermont</option>
            <option value="VA" <?php echo ((isset($property) && 'VA' == $property->state)? 'selected': '')?>>Virginia</option>
            <option value="WA" <?php echo ((isset($property) && 'WA' == $property->state)? 'selected': '')?>>Washington</option>
            <option value="WV" <?php echo ((isset($property) && 'WV' == $property->state)? 'selected': '')?>>West Virginia</option>
            <option value="WI" <?php echo ((isset($property) && 'WI' == $property->state)? 'selected': '')?>>Wisconsin</option>
            <option value="WY" <?php echo ((isset($property) && 'WY' == $property->state)? 'selected': '')?>>Wyoming</option>
        </select>    
    </div>
    <input type="hidden" name="propertyId" id="propertyId" value=<?php echo ((isset($property) && $property->isValid('propertyId'))? $property->propertyId: '') ;?>>
    <button type="submit" class="btn btn-primary">Save</button>
</form>