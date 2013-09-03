<script>
    function editRecord(id) {
        window.location.replace('/update/propertyId/'+id);
    }
    
    function deleteRecord(id) {
        r = confirm('Are you sure you want to delete this record?');
        if (r == true) {                    
            window.location.replace('/delete/propertyId/'+id);           
        }
    }
    
    function addSale() {
        // Test if date is valid
        var date_regex = /^(0[1-9]|1[0-2])\/(0[1-9]|1\d|2\d|3[01])\/(19|20)\d{2}$/ ;
        var formValid = true;
        if (!date_regex.test($("#saleDate").val())) {
            formValid = false;
            $("#date-group").addClass('has-error');
            $("label[for='saleDate']").replaceWith('<label for="saleDate" class="text-danger" >Not a valid date. Date format is mm/dd/yyyy </label>');
        } else {
            $("#date-group").removeClass('has-error');
            $("label[for='saleDate']").replaceWith('<label for="saleDate">Date </label>');
        }
        
        // Test if price is valid
        if (!$.isNumeric($("#salePrice").val())) {
            formValid = false;
            $("#price-group").addClass('has-error');
            $("label[for='salePrice']").replaceWith('<label for="salePrice" class="text-danger" id="price-error">Not a valid price</label>');
        } else {
            $("#price-group").removeClass('has-error');
            $("label[for='salePrice']").replaceWith('<label for="salePrice" >Price</label>');
        }
            
        if (formValid)
        {
            $("#sale-form").modal("hide");
            $.post(
                '/add-sale', 
                $("#sale-form-data").serialize()
            )
            .done(
                function(data){
                    $("#no-history").fadeOut("slow");
                    $("#history").append(data);
                }
            )
            .fail(
                function(data){
                    // Houston, we've got a problem
                    alert(data.responseJSON.message);
                    console.log(data.responseJSON.errorMessage);
                }
            );
        }
    }

</script>
<div class="modal fade" id="sale-form">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add sale price for this property</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="sale-form-data">
                    <div class="form-group" id="price-group">
                        <label for="salePrice">Price</label>
                        <input type="text" id="salePrice" name="salePrice" class="form-control" placeholder="Enter price">
                    </div>
                    <div class="form-group" id="date-group">
                        <label for="saleDate">Date</label>
                        <input class="form-control"type="text" name="saleDate" id="saleDate" placeholder="Enter date">
                    </div>
                    <input type="hidden" id="propertyId" name ="propertyId" value=" <?php echo $property->propertyId; ?>">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary"onClick="addSale()">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php
if (!isset($property)) {
    echo '<div class="alert alert-danger"><h3>No property found with that ID </h3></div>';
} else {
    echo '<h3>Property details</h3>' . PHP_EOL;
    echo '<address>' . PHP_EOL;
    echo $property->address . '<br>' . PHP_EOL;
    echo $property->city . '<br>' . PHP_EOL;
    echo $property->zip . '<br>' . PHP_EOL;
    echo $property->state . '<br>' . PHP_EOL;
    echo '</address>' . PHP_EOL;
    echo '<button class="btn btn-primary" onClick="$(\'#sale-form\').modal(\'show\');">Add sale date</button>' . PHP_EOL;
    if (!$property->isValid('saleHistory')) {
        echo '<button class="btn btn-primary" onClick="editRecord(' . $property->propertyId . ')">Edit data</button>' . PHP_EOL;
        echo '<button class="btn btn-danger" onClick="deleteRecord(' . $property->propertyId . ')">Delete this record</button>' . PHP_EOL;
    }
    echo '<h4>Sale history</h4>' . PHP_EOL;
    echo '<div class="table-responsive col-lg-4 col-md-4">' . PHP_EOL;
    echo '<table id="history" class="table table-hover table-striped ">' . PHP_EOL;
    if (!$property->isValid('saleHistory')) {
        echo '<div class="alert alert-warning" id="no-history">No history found for this property</div>' . PHP_EOL;
    } else {
        echo '<th>Sale Date</th><th>Sale Price</th>';
        foreach ($property->saleHistory as $history) {
            echo '<tr><td>' . $history->saleDate . '</td><td>' . number_format($history->salePrice, 2). '</td></tr>' .PHP_EOL;
        }
    }
    echo '</table>' . PHP_EOL;
    echo '</div>' . PHP_EOL;
}
?>