<div class="index-container container">
	<div class="row" style="margin-bottom: 50px;">
		<button type="button" onclick="window.location.href='/Realestate/create'"
			class="btn btn-primary">Add a Property</button>

	</div>
	<div class="row">
		
		<small style="color:red;">*Click one of the properties below to 'Add a Sale', 'Edit Property', or 'Delete Property'.</small>
	</div>

	<?php foreach ($content as $key => $row) : ?>
	
		<a href="/Realestate?realestate_id=<?= $row[0] ?>">
		<div class="row" style="border:1px solid #eee; padding:5px;margin-bottom: 15px;">
			<div class="col-12 col-md-8">
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
			<div class="col-12 col-md-4">
				<div>Sales Count</div>
				<div><?= $row['sales'] ?></div>
			</div>
		</div>
		</a>
	<?php endforeach; ?>
	
</div>
