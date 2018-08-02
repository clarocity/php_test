<?php

$pdo = new PDO("mysql:host=localhost", 'root', '');
$pdo->exec("USE nwick_php_test");

switch ($_POST['do']){

	case 'addProperty': var_dump($_POST);
	//Also handles editing.
	//if property already has an id, they're just editing it.  Do updates.
	if($_POST['id'] != 0){
			$sql = "UPDATE properties SET address=:address, city=:city, state=:state, zip=:zip WHERE property_id = :property_id";
			$update = $pdo->prepare($sql);
			$update->execute(["address"=> $_POST['address'], "city"=>$_POST['city'], "state"=>$_POST['state'], "zip"=>$_POST['zip'], "property_id"=> $_POST['id']]);
							
			//take care of sales.  just delete old ones and insert what's there now.
			$sql = "DELETE FROM sales WHERE property_id = :property_id";
			$delete = $pdo->prepare($sql);
			$delete->execute(["property_id"=>$_POST['id']]);
// 			var_dump($_POST);
//  var_dump(json_decode($_POST['data']));
			$salesAndDates = json_decode($_POST['data']);
			
			if($salesAndDates){
				
				foreach($salesAndDates as $sale){		
					$sql = "INSERT INTO sales VALUES ('',:property_id, :sale_date, :sale_price)";
					$insert = $pdo->prepare($sql);
					$insert->execute(["property_id"=>$_POST['id'], "sale_date"=>$sale[1], "sale_price"=>$sale[0]]);
				}
			}
			echo $_POST['id'];
	}
	else{
		//Otherwise, create new property
		$sql = "SELECT COUNT(*) FROM properties WHERE address = :address AND city=:city AND state=:state AND zip= :zip";
		$duplicateCheck = $pdo->prepare($sql);
		$duplicateCheck->execute(["address"=> $_POST['address'], "city"=>$_POST['city'], "state"=>$_POST['state'], "zip"=>$_POST['zip']]);
		$count = $duplicateCheck->fetch()[0][0];
	
		if($count){
			echo 0;  //address already exists, error out
		}else{
			//create new property
			$sql = "INSERT INTO properties VALUES (0,:address, :city, :state, :zip)";
			$insert = $pdo->prepare($sql);
			$insert->execute(["address"=> $_POST['address'], "city"=>$_POST['city'], "state"=>$_POST['state'], "zip"=>$_POST['zip']]);
			
			$result = $pdo->query("SELECT MAX(property_id) FROM properties");
			$id = $result->fetch()[0];
		
			$salesAndDates = json_decode($_POST['data']);
			
			if($salesAndDates){
				foreach($salesAndDates as $sale){		
					$sql = "INSERT INTO sales VALUES ('',:property_id, :sale_date, :sale_price)";
					$insert = $pdo->prepare($sql);
					$insert->execute(["property_id"=>$id, "sale_date"=>$sale[1], "sale_price"=>$sale[0]]);
				}	
			}
		
			echo $id;
		}
	}
	break;


	case 'deleteProperty':
		//delete property.  cascades to delete assoc sales
		$sql = "DELETE FROM properties WHERE property_id = :property_id";
		$delete = $pdo->prepare($sql);
		$delete->execute(["property_id"=> $_POST['property_id']]);
	
		$sql = "DELETE FROM sales WHERE property_id = :property_id";
		$delete = $pdo->prepare($sql);
		$delete->execute(["property_id"=> $_POST['property_id']]);
		break;

	case 'deleteSale':
		//delete a single sale
		$sql = "DELETE FROM sales WHERE sale_id = :sale_id";
		$delete = $pdo->prepare($sql);
		$delete->execute(["sale_id"=> $_POST['sale_id']]);
	break;
	
	case 'allInfo':
	//get all sale and property info
		$sql = "SELECT p.property_id,p.address,p.city,p.state,p.zip, s.sale_id, s.sale_date, s.sale_price
				FROM properties p 
			    LEFT JOIN sales s ON s.property_id = p.property_id 
			    WHERE p.property_id = :property_id 
			    ORDER BY s.sale_date";
		$allInfo = $pdo->prepare($sql);
		$allInfo->execute(["property_id"=> $_POST['property_id']]);
		echo json_encode($allInfo->fetchAll(PDO::FETCH_ASSOC));					
	break;
	
	default:
		break;

}

?>