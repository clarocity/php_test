//handles adding new property and editing existing ones
function addNewProperty(){
	var address = $("#address").val() || '';
	var city = $("#city").val() || '';
	var state = $("#state").val() || '';
	var zip = $("#zip").val() || '';
	var existing_id = $("#existing_id").val() || 0;
	var salesAndDates= [[]];
	var count = $('.sale-section').length;  //how many so far in list  
	var price, date;

	for(var i=0; i<count; i++){
		price = $("#price_"+i).val() || '';
		date = $("#date_"+i).val() || '';
		salesAndDates[i][0] = price;
		salesAndDates[i][1] = date;
	}

	var salesAsString = JSON.stringify(salesAndDates);
	
    $.post('postFunctions.php', {  do: 'addProperty',
    							   id: existing_id,
								   address: address,
								   city: 	city,
								   state: 	state,
								   zip: 	zip,
								   data:    salesAsString,
								   dataType: 'json'}, function(id) {
		if(id == 0) {
			alert("That address already exists.");
		}
		else{
			$('form').get(0).reset();
			var detailButton = "<button type='button' class= 'btn btn-primary btn-xs'  data-toggle='modal' data-target='#addNewProperty'  onClick='allInfo("+id+");'>View Details</button>";
			var deleteButton = "<button type='button' class= 'btn btn-danger btn-xs' onClick='deleteProperty("+id+");'>Delete</button>";

			if(existing_id != 0){ //refresh that row
				$('#'+existing_id).get()[0].innerHTML = '<td>'+address+'</td><td>'+city+'</td><td>'+state+'</td><td>'+zip+'</td><td>'+detailButton+'</td><td>'+deleteButton+'</td>';
			}
			else{ //add it	  
				$('table').append('<tr id='+id+' ><td>'+address+'</td><td>'+city+'</td><td>'+state+'</td><td>'+zip+'</td><td>'+detailButton+'</td><td>'+deleteButton+'</td></tr>');
			}	
		}
	});	  
}

function deleteProperty(property_id){
    $.post('postFunctions.php', { do: 'deleteProperty',
                           		  property_id: property_id});
    $('#'+property_id).remove();                   		                           
}

function deleteSale(sale_id, inDB){
	if(inDB){
		$.post('postFunctions.php', { do: 'deleteSale',
									  sale_id: sale_id});
		$('#'+sale_id).remove(); 							  
	}else{
    	$('#sale_'+sale_id).remove(); 
    }                                                     
}

//get all the info for a specific property
function allInfo(property_id){
	//clear out the modal
    $('form').get(0).reset(); 
    $('.sale-section').remove();   
    
    //populate with data
    $.post('postFunctions.php', { do: 'allInfo',
                           		  property_id: property_id}, function(data){
                   var allInfo = JSON.parse(data);  		  
                   $('#address').val(allInfo[0]['address']);
                   $('#city').val(allInfo[0]['city']);
                   $('#state').val(allInfo[0]['state']);
                   $('#zip').val(allInfo[0]['zip']);
                   $('#existing_id').val(property_id);
                
                   if(allInfo[0]['sale_price'] || allInfo[0]['sale_date'] ){
					   allInfo.forEach((sale, index) => {
							var saleInputRows = "<div class='sale-section' id="+allInfo[index]['sale_id']+">"+
												"<label >Sale Price:</label><input class='sales' id='price_"+index+" placeholder='Sale Price' value="+allInfo[index]['sale_price']+"></input>"+
												"<label >Sale Date:</label><input class='sales' id='date_"+index+" placeholder='Sale Date' value="+allInfo[index]['sale_date']+"></input>"+				
												"<button type='button' class='btn btn-primary btn-xs' onClick='deleteSale("+allInfo[index]['sale_id']+",1);' >Delete Sale</button>"+
												"</div>";
							$('form').append(saleInputRows);
					   });
				   }                    		  
    });                     		                    		                    
}

function addSaleRow(){
		var count = $('.sale-section').length;  //how many so far in list   
		var saleInputRows = "<div class='sale-section' id='sale_"+count+"'>"+
							"<label >Sale Price:</label><input class='sales' id='price_"+count+"' placeholder='Sale Price' ></input>"+
							"<label >Sale Date:</label><input class='sales' id='date_"+count+"' placeholder='Sale Date' ></input>"+
							"<button type='button' class='btn btn-primary btn-xs' onClick='deleteSale("+count+", 0);' >Delete Sale</button>"+					
							"</div>";
		$('form').append(saleInputRows);

}


