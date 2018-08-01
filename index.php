<?php

//TODO, could add in future
//landing page/login
//option to view all properties or search
//option to filter
//order the results better
//map view
//confirmation on delete
//confirmation on save/ update
//also double check first if that's what they mean to click, and notify what sales also deleting
//add a datepicker to help with sale date format


//****NOTE: change $user and $password for your database
$user = 'root';
$password = '';

session_start();   

$pdo = new PDO("mysql:host=localhost", $user, $password);
$pdo->exec("USE nwick_php_test");

//if this is a new session, create the database and some test data
if(!isset($_SESSION['user'])){
	try {
		$pdo = new PDO("mysql:host=localhost", $user, $password);
		$pdo->exec("CREATE DATABASE IF NOT EXISTS nwick_php_test");
		$pdo->exec("USE nwick_php_test");

	} catch (PDOException $e) {echo 'error';
		die("DB ERROR: ". $e->getMessage());
	}

	$pdo->exec("CREATE TABLE IF NOT EXISTS properties (property_id INT NOT NULL AUTO_INCREMENT, address VARCHAR(256), city VARCHAR(256), state VARCHAR(2), zip varchar(10), PRIMARY KEY (property_id))");
	$pdo->exec("CREATE TABLE IF NOT EXISTS sales (sale_id INT NOT NULL AUTO_INCREMENT, property_id INT, sale_date DATE, sale_price DECIMAL(10,2), PRIMARY KEY (sale_id))");
	
	//simple test data
	for($i = 0; $i<10; $i++){
		$insert = $pdo->prepare("INSERT INTO properties VALUES (0, :address, :city, :state, :zip);");
		$insert->execute(["address"=> "12".$i." Main St", "city"=>"San Diego", "state"=>"CA", "zip"=>"92101"]);
	}

	$_SESSION['user'] = 'test_user';
}

$propertyTable = "<table id='propertyTable'><tr><th>Address</th><th>City</th><th 1>State</th><th colspan=1>Zip</th><th colspan=2></th><th colspan=2></th></tr>";
$propertyResults = $pdo->query("SELECT * FROM properties ORDER BY property_id");
	
while($row = $propertyResults->fetch() ) {
	//don't display the id
	$detailsButton = "<button type='button' class= 'btn btn-primary btn-xs' data-toggle='modal' data-target='#addNewProperty' onClick='allInfo({$row[0]})'>View Details</button>";
	$deleteButton =  "<button type='button' class= 'btn btn-danger btn-xs' onClick='deleteProperty({$row[0]})'>Delete</button>";
    $propertyTable .= "<tr id={$row[0]} ><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td><td>$detailsButton</td><td>$deleteButton</td></tr>"; 
} 

echo $propertyTable;
echo "<button type='button' class= 'btn btn-primary' data-toggle='modal' data-target='#addNewProperty' id='addNew' >Add New Property</button>";

?>


<!DOCTYPE HTML>
<html>
  <head>
    <title>Property Sales</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 

	<script type="text/javascript" src="ajaxCalls.js"></script>
	
	<style>
		table{
		  border: 1px solid black;
		  border-radius:20px;
		  margin: auto;
		}
		
		th{
	      background-color:skyblue;
	      text-align:left;
	      padding:10px;
		}
		
		td{
		  margin:10px;
		  padding:10px;
		  text-align:left;
		}

		#addNew{
			margin-left:80%;
			margin-top:20px;
			margin-right:20px;
		}
		</style>
	
	
</head>
<body>

<!~~ Modal ~~>
  <div class="modal fade" id="addNewProperty" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Property And Sales Info</h4>
        </div>
        <div class="modal-body">
			<form name='newPropertyForm' > 
			  <div class="form-group">
				  <label>Address:</label>
				  <input class="form-control short" id='address' name='address' placeholder='Address' ></input>
				  <input class="form-control" id='city' name='city' placeholder='City' ></input>
				  <input class="form-control" id='state' name='state' placeholder='State' ></input>
				  <input class="form-control" id='zip' name='zip' placeholder='Zip' ></input>
			</form>
        </div>
        <button type="button" class="btn btn-primary btn-xs" onClick='addSaleRow();' >Add Sale</button>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success"  data-dismiss="modal"  onClick='addNewProperty();'  >Save</button>
        </div>
      </div>
      </div>
  </div>

  
</body>
</html>

