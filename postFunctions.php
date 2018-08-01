<?php

$pdo = new PDO("mysql:host=localhost", 'root', '');
$pdo->exec("USE nwick_php_test");

switch ($_POST['do']){

	case 'addProperty':
		//create new property
		$sql = "SELECT COUNT(*) FROM properties WHERE address = :address AND city=:city AND state=:state AND zip= :zip";
		$duplicateCheck = $pdo->prepare($sql);
		$duplicateCheck->execute(["address"=> $_POST['address'], "city"=>$_POST['city'], "state"=>$_POST['state'], "zip"=>$_POST['zip']]);
		$count = $duplicateCheck->fetch()[0][0];

		if($count){
			echo 0;  //address already exists, error out
		}else{
			$sql = "INSERT INTO properties VALUES (0,:address, :city, :state, :zip)";
			$insert = $pdo->prepare($sql);
			$insert->execute(["address"=> $_POST['address'], "city"=>$_POST['city'], "state"=>$_POST['state'], "zip"=>$_POST['zip']]);
				
			$result = $pdo->query("SELECT MAX(property_id) FROM properties");
			$id = $result->fetch()[0];
	//		echo $id;
		//}

		//take care of sales
// 		$sql = "SELECT COUNT(*) FROM sales WHERE property_id = :property_id AND sale_date=:sale_date AND sale_price=:sale_price ";
// 		$duplicateCheck = $pdo->prepare($sql);
// 		$duplicateCheck->execute(["property_id"=>$_POST['property_id'], "sale_date"=>$_POST['sale_date'], "sale_price"=>$_POST['sale_price']]);
// 
// 		$count = $duplicateCheck->fetch()[0];
// 
// 		if($count){
// 			echo "This sale already exists for this address.";
// 		}else{

			$sql = "INSERT INTO sales VALUES ('',:property_id, :sale_date, :sale_price)";
			$insert = $pdo->prepare($sql);
			$insert->execute(["property_id"=>$id, "sale_date"=>$_POST['sale_date'], "sale_price"=>$_POST['sale_price']]);
	echo $id;
		}
		break;


	case 'edit':
		//edit property
		$sql = "INSERT INTO sales VALUES (0, :property_id, :sale_date, :sale_price)";
		$update = $pdo->prepare($sql);
		$update->execute(["property_id"=>$_POST['property_id'], "sale_date"=>$_POST['sale_date'], "sale_price"=>$_POST['sale_price']]);

		//edit sale
		$sql = "UPDATE sales SET sale_date = :sale_date, sale_price = :sale_price WHERE sale_id = :sale_id)";
		$update = $pdo->prepare($sql);
		$update->execute(["sale_date"=>$_POST['sale_date'], "sale_id"=>$_POST['sale_id']]);
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


	//delete sale
	case 'deleteSale':
		//delete a single sale
		$sql = "DELETE FROM sales WHERE sale_id = :sale_id";
		$delete = $pdo->prepare($sql);
		$delete->execute(["sale_id"=> $_POST['sale_id']]);
	break;
	
	case 'allInfo':
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