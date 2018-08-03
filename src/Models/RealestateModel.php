<?php
namespace Models;

use \PDO as PDO;

class RealestateModel {

	private $db;

	function __construct() {
		$this->db = Db::connect();
	}

	public function createPropertiesTable() {
		$table = "properties";

		try {
		     
		     $this->db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		     $sql ="CREATE table $table(
			     id INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
			     first_name VARCHAR( 50 ) NOT NULL, 
			     last_name VARCHAR( 250 ) NOT NULL,
			     address VARCHAR( 150 ) NOT NULL, 
			     city VARCHAR( 150 ) NOT NULL,
			     state VARCHAR( 100 ) NOT NULL,
			     zip VARCHAR( 50 ) NOT NULL);" ;
		     $this->db->exec($sql);

		     echo "Table properties has been created successfully";

		} catch (\PDOException $e) {

		    error_log($e->getMessage());
		}
	}


	public function create($data) {

		try {

			$stmt = $this->db->prepare("INSERT INTO properties 
											(first_name,
											 last_name, 
											 address,
											 city,
											 state,
											 zip 
											) 
										VALUES (?, ?, ?, ?, ?, ?)");
			$stmt->execute(
				[
					$data['first_name'], 
					$data['last_name'], 
					$data['address'], 
					$data['city'], 
					$data['state'], 
					$data['zip']
				]
			);
			$inserted = $stmt->rowCount();

		} catch (\PDOException $e) {

			error_log($e->getMessage());
		}
	}


	public function readAll() {

		$data = [];
		$stmt = $this->db->query('SELECT 
			properties.id as id, 
			first_name, 
			last_name, 
			address, 
			city, 
			state, 
			zip,
			IFNULL(COUNT(sales.sale_date), 0) AS sales 
		FROM properties
		LEFT JOIN sales
		ON properties.id = sales.realestate_id
		GROUP BY properties.id ');

		while ($row = $stmt->fetch()) {
		    array_push($data, $row);
		}

		return $data;
	}

	public function read($id) {
		$data = [];
		$stmt = $this->db->query("SELECT * FROM properties 
			LEFT JOIN sales
			ON properties.id = sales.realestate_id
			WHERE properties.id = $id");
		while ($row = $stmt->fetch()) {
		    array_push($data, $row);
		}

		return $data;
	}

	public function delete($id) {

		try {

			$stmt = $this->db->prepare("DELETE FROM properties WHERE id = ?");
			$stmt->execute([$id]);
			$deleted = $stmt->rowCount();

		} catch (\PDOException $e) {

			error_log($e->getMessage());
		}
	}

	public function update($data) {

		try {

			$stmt = $this->db->prepare("UPDATE properties 
				SET first_name = ?, 
					last_name = ?,
					address = ?,
					city = ?,
					state = ?,
					zip = ?
				WHERE id = ?");
			$stmt->execute([$data['first_name'], 
							$data['last_name'], 
							$data['address'], 
							$data['city'], 
							$data['state'], 
							$data['zip'],
							$data['realestate_id']
						]);
			$deleted = $stmt->rowCount();

		} catch (\PDOException $e) {

			error_log($e->getMessage());
		}
	}

}
