<div class="index-container row">

    <?php if (!empty($content[0][0])) : ?>

	<div class="col-12 m-botton-25">
		<div>
		    <?= $content[0]['first_name'] ?> <?= $content[0]['last_name'] ?>
		</div>
		<div>
			<?= $content[0]['address'] ?>
		</div>
		<div>
			<?= $content[0]['city'] ?>, <?= $content[0]['state'] ?> <?= $content[0]['zip'] ?>
		</div>
	</div>
	<div class="col-6 m-botton-25">
		<div class="row">
			<div class="col-12 col-md-4 m-botton-15">
				<button type="button" onclick="window.location.href='/Sales/salesform?realestate_id=<?= $content[0][0] ?>'" class="btn btn-primary">Add a Sale</button>
			</div>
			<div class="col-12 col-md-4 m-botton-15">
				<button type="button" onclick="window.location.href='/Realestate/update?realestate_id=<?= $content[0][0] ?>'" class="btn btn-primary">Edit Property</button>
			</div>
			<div class="col-12 col-md-4 m-botton-15">
				<form method="POST" action="/Realestate/delete">
					<input type="hidden" name="realestate_id" value="<?= $content[0][0] ?>" >
					<button type="submit" class="btn btn-danger">Delete Property</button>
				</form>
			</div>
		</div>
	</div>

	<div class="col-8">
		<h4>Properties Sales</h4>
	</div>

	<?php foreach ($content as $key => $row) : ?>

		<?php if(!empty($row['sale_date'])) : ?>

		<div class="col-8 m-botton-25">
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
			<div class="col-8 m-botton-15">
				<div class="row">
					<div class="col-12 col-md-8">
						<p>Property has not been sold.</p>
					</div>
				</div>
			</div>
		<?php endif; ?>

	<?php endforeach; ?>

	<?php else : ?>
			<div class="col-12">
				<div>
					<h4>Please return to the home page for a list of Real Estate properties.</h4>
				</div>
			</div>
			<div class="col-12">
				<div>
					<a href="/">Home</a>
				</div>
			</div>

	<?php endif; ?>
</div>


<script type="text/javascript">
	
(function() {
  'use strict';
  window.addEventListener('load', function() {
    
    var form = document.getElementsByTagName('form');
    var form = form[0];
    
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        event.stopPropagation();
        
        if (confirm('Are you sure you want to delete this property?')) {
			form.submit();
		}
    }, false);

  }, false);
})();

</script>