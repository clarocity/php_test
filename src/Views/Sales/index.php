<div class="index-container row">

    <?php if (!empty($content[0][0])) : ?>

    	<div class="col-12">
			<h4>Properties Sales</h4>
		</div>

		<div class="col-12">
			<div class="row">
				<div class="col-12 col-md-2" style="margin-bottom: 15px;">
					<button type="button" class="btn btn-primary" id="highest_sale">Highest Sale</button>
				</div>
				<div class="col-12 col-md-2" style="margin-bottom: 15px;">
					<button type="button" class="btn btn-primary" id="lowest_sale">Lowest Sale</button>
				</div>
			</div>
		</div>

		<?php foreach ($content as $key => $row) : ?>

			<div class="col-6" style="margin-bottom: 25px;">
				<div>
				    <?= $row['first_name'] ?> <?= $row['last_name'] ?>
				</div>
				<div>
					<?= $row['address'] ?>
				</div>
				<div>
					<?= $row['city'] ?>, <?= $row['state'] ?> <?= $row['zip'] ?>
				</div>
			</div>
			<?php if (!empty($row['sale_date'])) : ?>
				<div class="col-6" style="margin-bottom: 15px;">
					<div class="row">
						<div class="col-12 col-md-8">
							Sales Date: <?= $row['sale_date'] ?>
						</div>
						<div class="col-12 col-md-8">
							Sales Price: <?= money_format('%.2n', $row['sale_price']) ?>
						</div>
					</div>
				</div>
			<?php else : ?>
				<div class="col-6" style="margin-bottom: 15px;">
					<div class="row">
						<div class="col-12 col-md-8">
							No Sale
						</div>
					</div>
				</div>
			<?php endif; ?>
		<?php endforeach; ?>

    <?php else : ?>

    	<div class="col-12">
			<div>
				<h4>No record of sold properties at this time.</h4>
			</div>
		</div>
		<div class="col-12">
			<div>
				<a href="/">Home</a>
			</div>
		</div>

    <?php endif; ?>



	
	<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">

	      <div class="modal-header">
	        <h5 class="modal-title" id="ModalTitle">Modal title</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>

	      <div class="modal-body">
	        <div id="modal_name"></div>
	        <div id="modal_address"></div>
	        <div id="modal_csz"></div>
	        <br />
	        <div id="modal_sale_date"></div>
	        <div id="modal_sale_price"></div>
	      </div>


	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        
	      </div>
	    </div>
	  </div>
	</div>
</div>

<script type="text/javascript">

(function() {
  	'use strict';
  	window.addEventListener('load', function() {
    
    	var highest_button = document.getElementById('highest_sale');
    	var lowest_button = document.getElementById('lowest_sale');
    
    	highest_button.addEventListener('click', function(event) {
    		
    		getMinMax('max');
        	$('#exampleModalCenter').modal();
    	}, false);


    	lowest_button.addEventListener('click', function(event) {

    		getMinMax('min');
        	$('#exampleModalCenter').modal();
    	}, false);

  	}, false);
})();


function getMinMax(type) {

	$.ajax({
		url: "/Sales/" + type,
		dataType: 'json'
	}).done(function( data ) {

		$('#ModalTitle').html('Highest Sale');
		$('#modal_name ').html(data.first_name + " " + data.last_name);
		$('#modal_address ').html(data.address);
		$('#modal_csz ').html(data.city + ", " + data.state + " " + data.zip);
		$('#modal_sale_date').html("Sale Date: " + data.sale_date);
		$('#modal_sale_price').html("Sale Price: $"+data.sale_price);

	});

}

</script>