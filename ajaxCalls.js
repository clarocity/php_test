
function addNewProperty(){
	var address = $("#address").val() || '';
	var city = $("#city").val() || '';
	var state = $("#state").val() || '';
	var zip = $("#zip").val() || '';
	
//ADJUST THIS SO CAN ADD SALES AT SAME TIME	
    $.post('postFunctions.php', {  do: 'addProperty',
								   address: address,
								   city: 	city,
								   state: 	state,
								   zip: 	zip }, function(id) {
		  if (id == 0) {
			alert("That address already exists.");
		  } else{
		  	  $('form').get(0).reset();
		  	  var detailButton = "<button type='button' class= 'btn btn-primary btn-xs'  data-toggle='modal' data-target='#addNewProperty'  onClick='allInfo("+id+");'>View Details</button>";
			  var deleteButton = "<button type='button' class= 'btn btn-danger btn-xs' onClick='deleteProperty("+id+");'>Delete</button>";
			  $('table').append('<tr id='+id+' ><td>'+address+'</td><td>'+city+'</td><td>'+state+'</td><td>'+zip+'</td><td>'+detailButton+'</td><td>'+deleteButton+'</td></tr>');
		  }
		});	  
}

function deleteProperty(property_id){
    $.post('postFunctions.php', { do: 'deleteProperty',
                           		  property_id: property_id});
    $('#'+property_id).remove();                   		                           
}

function deleteSale(sale_id){
    $.post('postFunctions.php', { do: 'deleteSale',
                                  sale_id: sale_id}); 
    $('#'+sale_id).remove();                                                       
}

function allInfo(property_id){
	//clear out the modal
    $('form').get(0).reset(); 
    $('.sales').remove();   
    
    //populate with data
    $.post('postFunctions.php', { do: 'allInfo',
                           		  property_id: property_id}, function(data){
                   var allInfo = JSON.parse(data);  		  
                   $('#address').val(allInfo[0]['address']);
                   $('#city').val(allInfo[0]['city']);
                   $('#state').val(allInfo[0]['state']);
                   $('#zip').val(allInfo[0]['zip']);
                
                   if(allInfo[0]['sale_price'] || allInfo[0]['sale_date'] ){
					   allInfo.forEach((sale, index) => {
							var saleInputRows = "<div>"+
												"<label  for='input-sm' >Sale Date:</label><input class='form-control sales input-sm' id='price_"+index+" name='allInfo[index][price]' placeholder='Sale Price' value="+allInfo[index]['sale_price']+"></input>"+
												"<label  for='input-sm'>Sale Price:</label><input class='form-control sales input-sm' id='date_"+index+"  name='allInfo[index][date]' placeholder='Sale Date' value="+allInfo[index]['sale_date']+"></input>"+
												"</div>";
							$('form').append(saleInputRows);
					   });
				   }
 
                           		  
                           		  
    });                     		                    		                    
}

// 
// //not an ajax call
// function addSaleRow(){
// 	$("#addSaleRow").click(function(){
// 		var saleInputRows = "<div>'+
// 				"<input class='form-control' id='price' name='sale[price]' placeholder='Sale Price' ></input>"+
// 				"<input class='form-control' id='date'  name='date[price]' placeholder='Sale Date' ></input>";
// 			</div>';
// 		$('form').append(saleInputRows);
// 	}); 
// }


