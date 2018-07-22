<div class="container">
  <div class="row">
    <h3>Create New Sale</h3>
  </div>
</div>
<?php 
  $was_validated = '';
  if($content['error']) {
    $was_validated = 'was-validated';
  }
?>
<form action="/Sales/salesform" method="POST" class="needs-validation <?php echo $was_validated; ?>" novalidate>

  <input type="hidden" name="realestate_id" value="<?= $content['data']['realestate_id'] ?>">

  <div class="form-row">

  </div>

  <div class="form-row">

    <div class="col-md-6 mb-3">
      <label for="validationCustom01">Sale Date</label>
      <input type="text" class="form-control" id="validationCustom01" placeholder="Date" name="sale_date" value="<?= $content['data']['sale_date'] ?>" required>
      <div class="invalid-feedback">
        Please select a valid date.
      </div>
    </div>


    <div class="col-md-6 mb-3">
      <label for="validationCustom02">Sale Price</label>

      <input type="text" class="form-control" id="validationCustom02" placeholder="Sale Price" name="sale_price" value="<?= $content['data']['sale_price'] ?>" required>
      <div class="invalid-feedback">
        Please enter a valid price.
      </div>
    </div>
  </div>

  <button class="btn btn-primary" type="submit">Add Sale</button><a href="/Realestate?realestate_id=<?= $content['data']['realestate_id'] ?>" class="cancel-button">Cancel</a>
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

    $( "#validationCustom01" ).datepicker({
        dateFormat: 'yy-mm-dd'
    });

  }, false);
})();
</script>




