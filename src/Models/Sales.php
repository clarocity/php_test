<?php
namespace Models;

use \PDO as PDO;

class Sales extends Model{

	function __construct() {
		parent::__construct();
	}

	public function getAmounts() {
		return 101;
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
			     county VARCHAR( 150 ) NOT NULL, 
			     state VARCHAR( 100 ) NOT NULL,
			     zip VARCHAR( 50 ) NOT NULL,
			     phone VARCHAR( 50 ) NOT NULL);" ;
		     $this->db->exec($sql);

		     echo "Table properties has been created successfully";

		} catch(\PDOException $e) {

		    error_log($e->getMessage());
		    
		}
	}

	public function create() {


	}

	public function read() {


	}

	public function update() {


	}


	public function delete() {
		

	}

}


?>