<?php
require_once 'Property.php';

$property = new Property();
$sales = $property->salesList($_POST['id']);
?>
<div class="panel panel-default">
    <div class="panel-body">
        <h2>Property Sales Data</h2>
        <table id="propertySalesList" class="table table-striped table-bordered table-hover">
          <thead>
              <tr>
                  <th class="">Address</th>
                  <th class="">Sale Date</th>
                  <th class="">Sale Price</th>
                  <th class="text-right">Actions</th>
              </tr>
          </thead>
          <tbody>
            <?php if(count($sales) > 0) { ?>
                <?php foreach($sales as $s): ?>
                    <tr>
                        <td><?php echo $s['address']; ?></td>
                        <td><?php echo date('M jS, Y', strtotime($s['sale_date'])); ?></td>
                        <td>$<?php echo number_format($s['sale_price']); ?></td>
                        <td></td>
                    </tr>
                <?php endforeach; ?>
            <?php } else { ?>
                <tr><td colspan="4" class="text-center">This property has no sales data.</td></tr>
            <?php } ?>
          </tbody>
        </table>        
    </div>
</div>


