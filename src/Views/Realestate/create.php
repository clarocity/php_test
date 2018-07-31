<div class="container">
  <div class="row">
    <h3>Create New Property</h3>
  </div>
</div>

<form action="/Realestate/create" method="POST" class="needs-validation" novalidate>
  <input type="hidden" name="csrf_token" value="<?= $content['data']['csrf_token'] ?>"/>
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="validationCustom01">First name</label>
      <input type="text" class="form-control <?= $content['errors']['first_name'] ?>" id="validationCustom01" placeholder="First name" name="first_name" value="<?php echo $content['data']['first_name']; ?>" required>
      <div class="invalid-feedback">
          Please provide a valid first name.
        </div>
    </div>
    <div class="col-md-6 mb-3">
      <label for="validationCustom02">Last name</label>

      <input type="text" class="form-control <?= $content['errors']['last_name'] ?>" id="validationCustom02" placeholder="Last name" name="last_name" value="<?php echo $content['data']['last_name']; ?>" required>
      <div class="invalid-feedback">
          Please provide a valid last name.
        </div> 
    </div>
  </div>

  <div class="form-row">
    <div class="col-md-12 mb-3">
      <label for="validationCustomAddress">Address</label>
        
        <input type="text" class="form-control <?= $content['errors']['address'] ?>" id="validationCustomAddress" placeholder="Address" name="address" value="<?php echo $content['data']['address']; ?>" aria-describedby="inputGroupPrepend" required>
        <div class="invalid-feedback">
          Please provide a valid address.
        </div>
    </div>
  </div>

  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="validationCustom03">City</label>
      <input type="text" class="form-control <?= $content['errors']['city'] ?>" id="validationCustom03" placeholder="City" name="city" value="<?php echo $content['data']['city']; ?>" required>
      <div class="invalid-feedback">
        Please provide a valid city.
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <label for="validationCustom04">State</label>
      <input type="text" class="form-control <?= $content['errors']['state'] ?>" id="validationCustom04" placeholder="State" name="state" value="<?php echo $content['data']['state']; ?>" required>
      <div class="invalid-feedback">
        Please provide a valid state.
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <label for="validationCustom05">Zip</label>
      <input type="text" class="form-control <?= $content['errors']['zip'] ?>" id="validationCustom05" placeholder="Zip" name="zip" value="<?php echo $content['data']['zip']; ?>" required>
      <div class="invalid-feedback">
        Please provide a valid zip.
      </div>
    </div>
  </div>
  <div class="m-bottom-15">
    <button class="btn btn-primary" type="submit">Add Property</button><a href="/" class="cancel-button">Cancel</a>
  </div>
</form>

<script>

(function() {
  'use strict';
  window.addEventListener('load', function() {
    
    var forms = document.getElementsByClassName('needs-validation');
    
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>



