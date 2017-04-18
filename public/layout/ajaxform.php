<br />
<form id="<?php echo $formId; ?>">
  <button type="button" class="close" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <h2><?php echo $formHeading; ?></h2>
  <div class="form-group">
    <label for="address">Address</label>
    <input type="text" class="form-control" id="address" name="address" 
    value='<?php if($formConvert){echo $property->get('address');}else{echo null;} ?>' />
  </div>
  <div class="form-group">
    <label for="City">City:</label>
    <input type="text" class="form-control" id="city" name="city"
    value='<?php if($formConvert){echo $property->get('city');}else{echo "";} ?>' />
  </div>
  <div class="form-group">
    <label for="State">State:</label>
    <input type="text" class="form-control" id="state" name="state"
    value='<?php if($formConvert){echo $property->get('state');}else{echo null;} ?>' />
  </div>
  <div class="form-group">
    <label for="zip">Zip Code:</label>
    <input type="text" class="form-control" id="zip" name="zip"
    value='<?php if($formConvert){echo $property->get('zip');}else{echo null;} ?>' />
  </div>
  <button type="submit" name="<?php echo $formSubmit; ?>" class="btn btn-primary"><?php echo $btnSubmit; ?></button>
  <div class="message--form"></div>
</form>