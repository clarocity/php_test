$(function() {	
    // get property list
    $.post('ajax.php', { 'action' : 'index' }, function(r) {
        if(r.status == '1') {
        	r.properties.forEach(function(e) {
     		    //append tbl row
     		    add_tbl_row(e);
        	});
        }
    });
    
    //load add property form
    $('.add-property').click(function() {
    	$('#pgContainer').fadeOut('slow', function(){
    	    $(this).load('property_form.html', function(){
    	    	$('h2.title').text('Add New Property');
    	    	$('#btnSubmitCont').html("<button type='button' class='btn btn-primary' id='btnAddProperty'><i class='glyphicon glyphicon-check'></i> Add Property</button>");
    	    	
    	        $('#pgContainer').fadeIn('slow');
    	    });
    	});

        return false; 
    });
});

$(document).on('click', '#btnAddProperty', function() {
	var success = true;
	
    $('div.required-msg').remove();            
    $('input[required], select[required]').each(function(i, e) {
        if($(e).val() == "") {
            success = false;
            $(this).after("<div class='required-msg'>" + $(this).data('required-msg') + "</div>"); 
        }
    });
	
    $.post('ajax.php', { 
        action  : "add",
        address : $('#propAddress').val(),
        city    : $('#propCity').val(),
        state   : $('#propState').val(),
        zip     : $('#propZip').val()
    }, function(r) {
        if(r.status == '1') {
            //add tbl row
            add_tbl_row(r.property);

    	    //reset well
    	    reset_well();
        }
    }, 'json');
    
    return false;
});

$(document).on('click', '.edit-property', function() {
	var id = $(this).closest('tr').data('id');
	
	$('#pgContainer').fadeOut('slow', function(){
	    $(this).load('property_form.html', function(){
	    	$('h2.title').text('Edit Property');
	    	$('#btnSubmitCont').html("<button type='button' class='btn btn-primary' id='btnEditProperty'><i class='glyphicon glyphicon-check'></i> Save Property</button>");
	    	
	    	$.post('ajax.php', { 
	            action  : "read",
	            id 		: id
	        }, function(r) {
	            if(r.status == '1') {
	            	//load form values
	            	$('#propId').val(r.property.id);
	            	$('#propAddress').val(r.property.address);
	            	$('#propCity').val(r.property.city);
	            	$('#propState').val(r.property.state);
	            	$('#propZip').val(r.property.zip);
	            	
	            	$('#pgContainer').fadeIn('slow');
	            } else {
	            	reset_well();
	            }
	        }, 'json');
	    });
	});

    return false;
});

$(document).on('click', '#btnEditProperty', function() {
	var success = true;
	
    $('div.required-msg').remove();            
    $('input[required], select[required]').each(function(i, e) {
        if($(e).val() == "") {
            success = false;
            $(this).after("<div class='required-msg'>" + $(this).data('required-msg') + "</div>"); 
        }
    });
	
    $.post('ajax.php', { 
        action  : "edit",
        id		: $('#propId').val(),
        address : $('#propAddress').val(),
        city    : $('#propCity').val(),
        state   : $('#propState').val(),
        zip     : $('#propZip').val()
    }, function(r) {
        if(r.status == '1') {
        	//redraw tbl row
        	var tr = $('tr[data-id=' + $('#propId').val() + ']');
        	tr.find('td.addr').text($('#propAddress').val());
        	tr.find('td.city').text($('#propCity').val());
        	tr.find('td.state').text($('#propState').val());
        	tr.find('td.zip').text($('#propZip').val());
        	
    	    //reset well
    	    reset_well();
        }
    }, 'json');
    
    return false;
});

$(document).on('click', '.del-property', function() {
	var id = $(this).closest('tr').data('id');
	
	$.post('ajax.php', { 
        action  : "delete",
        id 		: id
    }, function(r) {
        if(r.status == '1') {
        	//delete tbl row
        	$('tr[data-id=' + id + ']').fadeOut('slow').remove();
        } else {
        	reset_well();
        }
    }, 'json');
});

$(document).on('click', '.view-sales', function() {
	var id = $(this).closest('tr').data('id');
	
	$('#pgContainer').fadeOut('slow', function(){
	    $(this).load('sales_tbl.php', {
	    	id : id
	    }, function() {
	        $('#pgContainer').fadeIn('slow');
	    });
	});
});



function reset_well() {
    $('#pgContainer').fadeOut('fast').html("<h2>Clarocity Property List</h2>").fadeIn('slow');
}

function add_tbl_row(address) {
	var html = "";
	    html += "<tr data-id='" + address.id + "'>";
	    html += "<td class='addr'>" + address.address + "</td>";
	    html += "<td class='city'>" + address.city + "</td>";
		html += "<td class='state text-center'>" + address.state + "</td>";
		html += "<td class='zip text-center'>" + address.zip + "</td>";
		html += "<td class='times-sold text-center'>" + address.times_sold + "</td>";
		var last_sale = (address.last_sale == null) ? "Never Sold" : '$' + address.last_sale; 
		html += "<td class='last-sale text-center'>" + last_sale + "</td>";
		html += "<td class='text-right'>";
		html += "<div class='btn-group' role='group' aria-label='...'>";
		html += "<button type='button' class='btn btn-info view-sales btn-sm'><i class='glyphicon glyphicon-usd'></i> View Sales</button>";
		html += "<button type='button' class='btn btn-info edit-property btn-sm'><i class='glyphicon glyphicon-edit'></i> Edit</button>";
		html += "<button type='button' class='btn btn-danger del-property btn-sm'><i class='glyphicon glyphicon-remove-circle'></i> Delete</button>";
		html += "</div>";
		html += "</td>";
		html += "</tr>";
		
    $('#propertyList tbody').append(html);
}
