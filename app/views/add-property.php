<?php
if (isset($this->errors)) {
    echo '<div class="alert alert-danger">' . $this->errors . '</div>';
}
if (isset($this->recordId)) {
    echo '<div class="alert alert-info">Record updated successfully</div>';
}
?>
<div class="row col-lg-6 col-lg-offset-3">
    <form role="form" method="post">
        <div class="form-group <?php echo (isset($this->property) && !$this->property->isValid('address')) ? 'has-error' : ''; ?>">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address" value="<?php echo (isset($this->property) && $this->property->isValid('address')) ? $this->property->address : ''; ?>">
        </div>
        <div class="form-group <?php echo (isset($this->property) && !$this->property->isValid('city')) ? 'has-error' : ''; ?>">
            <label for="city">City</label>
            <input type="text" class="form-control" id="city" name="city" placeholder="Enter City" value="<?php echo (isset($this->property) && $this->property->isValid('city')) ? $this->property->city : ''; ?>">
        </div>
        <div class="form-group <?php echo (isset($this->property) && !$this->property->isValid('zip')) ? 'has-error' : ''; ?>">
            <label for="zip">ZIP Code</label>
            <input type="text" class="form-control" id="zip" name="zip" placeholder="Enter ZIP Code"  value="<?php echo (isset($this->property) && $this->property->isValid('zip')) ? $this->property->zip : ''; ?>">
        </div>
        <div class="form-group <?php echo (isset($this->property) && !$this->property->isValid('state')) ? 'has-error' : ''; ?>">
            <label for="state">Select State</label>
            <select class="form-control" name="state" id="state">
                <option value="-1" disabled <?php echo ((!isset($this->property) || (isset($this->property) && '' == $this->property->state)) ? 'selected' : '') ?>>Select Sate</option>
                <option value="AL" <?php echo ((isset($this->property) && 'AL' == $this->property->state) ? 'selected' : '') ?>>Alabama</option>
                <option value="AK" <?php echo ((isset($this->property) && 'AK' == $this->property->state) ? 'selected' : '') ?>>Alaska</option>
                <option value="AZ" <?php echo ((isset($this->property) && 'AZ' == $this->property->state) ? 'selected' : '') ?>>Arizona</option>
                <option value="AR" <?php echo ((isset($this->property) && 'AR' == $this->property->state) ? 'selected' : '') ?>>Arkansas</option>
                <option value="CA" <?php echo ((isset($this->property) && 'CA' == $this->property->state) ? 'selected' : '') ?>>California</option>
                <option value="CO" <?php echo ((isset($this->property) && 'CO' == $this->property->state) ? 'selected' : '') ?>>Colorado</option>
                <option value="CT" <?php echo ((isset($this->property) && 'CT' == $this->property->state) ? 'selected' : '') ?>>Connecticut</option>
                <option value="DE" <?php echo ((isset($this->property) && 'DE' == $this->property->state) ? 'selected' : '') ?>>Delaware</option>
                <option value="DC" <?php echo ((isset($this->property) && 'DC' == $this->property->state) ? 'selected' : '') ?>>District of Columbia</option>
                <option value="FL" <?php echo ((isset($this->property) && 'FL' == $this->property->state) ? 'selected' : '') ?>>Florida</option>
                <option value="GA" <?php echo ((isset($this->property) && 'GA' == $this->property->state) ? 'selected' : '') ?>>Georgia</option>
                <option value="HI" <?php echo ((isset($this->property) && 'HI' == $this->property->state) ? 'selected' : '') ?>>Hawaii</option>
                <option value="ID" <?php echo ((isset($this->property) && 'ID' == $this->property->state) ? 'selected' : '') ?>>Idaho</option>
                <option value="IL" <?php echo ((isset($this->property) && 'IL' == $this->property->state) ? 'selected' : '') ?>>Illinois</option>
                <option value="IN" <?php echo ((isset($this->property) && 'IN' == $this->property->state) ? 'selected' : '') ?>>Indiana</option>
                <option value="IA" <?php echo ((isset($this->property) && 'IA' == $this->property->state) ? 'selected' : '') ?>>Iowa</option>
                <option value="KS" <?php echo ((isset($this->property) && 'KS' == $this->property->state) ? 'selected' : '') ?>>Kansas</option>
                <option value="KY" <?php echo ((isset($this->property) && 'KY' == $this->property->state) ? 'selected' : '') ?>>Kentucky</option>
                <option value="LA" <?php echo ((isset($this->property) && 'LA' == $this->property->state) ? 'selected' : '') ?>>Louisiana</option>
                <option value="ME" <?php echo ((isset($this->property) && 'ME' == $this->property->state) ? 'selected' : '') ?>>Maine</option>
                <option value="MD" <?php echo ((isset($this->property) && 'MD' == $this->property->state) ? 'selected' : '') ?>>Maryland</option>
                <option value="MA" <?php echo ((isset($this->property) && 'MA' == $this->property->state) ? 'selected' : '') ?>>Massachusetts</option>
                <option value="MI" <?php echo ((isset($this->property) && 'MI' == $this->property->state) ? 'selected' : '') ?>>Michigan</option>
                <option value="MN" <?php echo ((isset($this->property) && 'MN' == $this->property->state) ? 'selected' : '') ?>>Minnesota</option>
                <option value="MS" <?php echo ((isset($this->property) && 'MS' == $this->property->state) ? 'selected' : '') ?>>Mississippi</option>
                <option value="MO" <?php echo ((isset($this->property) && 'MO' == $this->property->state) ? 'selected' : '') ?>>Missouri</option>
                <option value="MT" <?php echo ((isset($this->property) && 'MT' == $this->property->state) ? 'selected' : '') ?>>Montana</option>
                <option value="NE" <?php echo ((isset($this->property) && 'NE' == $this->property->state) ? 'selected' : '') ?>>Nebraska</option>
                <option value="NV" <?php echo ((isset($this->property) && 'NV' == $this->property->state) ? 'selected' : '') ?>>Nevada</option>
                <option value="NH" <?php echo ((isset($this->property) && 'NH' == $this->property->state) ? 'selected' : '') ?>>New Hampshire</option>
                <option value="NJ" <?php echo ((isset($this->property) && 'NJ' == $this->property->state) ? 'selected' : '') ?>>New Jersey</option>
                <option value="NM" <?php echo ((isset($this->property) && 'NM' == $this->property->state) ? 'selected' : '') ?>>New Mexico</option>
                <option value="NY" <?php echo ((isset($this->property) && 'NY' == $this->property->state) ? 'selected' : '') ?>>New York</option>
                <option value="NC" <?php echo ((isset($this->property) && 'NC' == $this->property->state) ? 'selected' : '') ?>>North Carolina</option>
                <option value="ND" <?php echo ((isset($this->property) && 'ND' == $this->property->state) ? 'selected' : '') ?>>North Dakota</option>
                <option value="OH" <?php echo ((isset($this->property) && 'OH' == $this->property->state) ? 'selected' : '') ?>>Ohio</option>
                <option value="OK" <?php echo ((isset($this->property) && 'OK' == $this->property->state) ? 'selected' : '') ?>>Oklahoma</option>
                <option value="OR" <?php echo ((isset($this->property) && 'OR' == $this->property->state) ? 'selected' : '') ?>>Oregon</option>
                <option value="PA" <?php echo ((isset($this->property) && 'PA' == $this->property->state) ? 'selected' : '') ?>>Pennsylvania</option>
                <option value="RI" <?php echo ((isset($this->property) && 'RI' == $this->property->state) ? 'selected' : '') ?>>Rhode Island</option>
                <option value="SC" <?php echo ((isset($this->property) && 'SC' == $this->property->state) ? 'selected' : '') ?>>South Carolina</option>
                <option value="SD" <?php echo ((isset($this->property) && 'SD' == $this->property->state) ? 'selected' : '') ?>>South Dakota</option>
                <option value="TN" <?php echo ((isset($this->property) && 'TN' == $this->property->state) ? 'selected' : '') ?>>Tennessee</option>
                <option value="TX" <?php echo ((isset($this->property) && 'TX' == $this->property->state) ? 'selected' : '') ?>>Texas</option>
                <option value="UT" <?php echo ((isset($this->property) && 'UT' == $this->property->state) ? 'selected' : '') ?>>Utah</option>
                <option value="VT" <?php echo ((isset($this->property) && 'VT' == $this->property->state) ? 'selected' : '') ?>>Vermont</option>
                <option value="VA" <?php echo ((isset($this->property) && 'VA' == $this->property->state) ? 'selected' : '') ?>>Virginia</option>
                <option value="WA" <?php echo ((isset($this->property) && 'WA' == $this->property->state) ? 'selected' : '') ?>>Washington</option>
                <option value="WV" <?php echo ((isset($this->property) && 'WV' == $this->property->state) ? 'selected' : '') ?>>West Virginia</option>
                <option value="WI" <?php echo ((isset($this->property) && 'WI' == $this->property->state) ? 'selected' : '') ?>>Wisconsin</option>
                <option value="WY" <?php echo ((isset($this->property) && 'WY' == $this->property->state) ? 'selected' : '') ?>>Wyoming</option>
            </select>    
        </div>
        <input type="hidden" name="propertyId" id="propertyId" value=<?php echo ((isset($this->property) && $this->property->isValid('propertyId')) ? $this->property->propertyId : ''); ?>>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>