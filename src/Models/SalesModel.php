<?php
namespace Models;

use \PDO as PDO;

class SalesModel extends Model {

	function __construct() {
		parent::__construct();
	}

	public function createSalesTable() {
		$table = "sales";

		try {
		     
		    $this->db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		    $sql ="CREATE table $table(
			    id INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
			    realestate_id INT( 11 ) NOT NULL,
			    sale_date DATE NOT NULL,
			    sale_price DECIMAL(12, 2) NOT NULL,
			FOREIGN KEY (realestate_id)
        	REFERENCES properties (id)
        	ON DELETE CASCADE);" ;
		     $this->db->exec($sql);

		    echo "Table sales has been created successfully";

		} catch (\PDOException $e) {

		    error_log($e->getMessage());
		}
	}


	public function create($data) {

		$sale_price = (float)$data['sale_price'];

		try {

			$stmt = $this->db->prepare("INSERT INTO sales 
											(realestate_id,
											 sale_date, 
											 sale_price
											) 
										VALUES (?, ?, ?)");
			$stmt->execute(
				[
					$data['realestate_id'],
					$data['sale_date'],
					$sale_price
				]
			);
			$inserted = $stmt->rowCount();

		} catch (\PDOException $e) {

			error_log($e->getMessage());
		}
	}

	public function read() {

		try {
			$data = [];
			$stmt = $this->db->query('SELECT 
				properties.id as id, 
				first_name, 
				last_name, 
				address, 
				city, 
				state, 
				zip,
				sale_price,
				sale_date
			FROM properties
			LEFT JOIN sales
			ON properties.id = sales.realestate_id');

			while ($row = $stmt->fetch()) {
			    array_push($data, $row);
			}

			return $data;

		} catch (\PDOException $e) {

			error_log($e->getMessage());
		}
	}

	public function min() {

		try {
			$data = [];
			$stmt = $this->db->query('SELECT 
				properties.id as id, 
				first_name, 
				last_name, 
				address, 
				city, 
				state, 
				zip,
				sale_price,
				sale_date
			FROM properties
			LEFT JOIN sales
			ON properties.id = sales.realestate_id
	        WHERE sale_price = (SELECT MIN(sale_price) FROM sales)');

			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			    array_push($data, $row);
			}

			return $data;

		} catch (\PDOException $e) {

			error_log($e->getMessage());
		}

	}

    public function max() {

    	try {
			$data = [];
			$stmt = $this->db->query('SELECT 
				properties.id as id, 
				first_name, 
				last_name, 
				address, 
				city, 
				state, 
				zip,
				sale_price,
				sale_date
			FROM properties
			LEFT JOIN sales
			ON properties.id = sales.realestate_id
	        WHERE sale_price = (SELECT MAX(sale_price) FROM sales)');

			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			    array_push($data, $row);
			}

			return $data;
			
		} catch (\PDOException $e) {

			error_log($e->getMessage());
		}
    }
}


?>