<?php
namespace Models;

use \PDO as PDO;
use \Config as Config;

class Model {

	public $db;

	function __construct() {

		$dsn =  Config::$config['db']['dsn'];
		$user = Config::$config['db']['user'];
		$password = Config::$config['db']['password'];

		try {

			if ( ($this->db instanceof PDO) != true ) {
    			$this->db = new PDO($dsn, $user, $password);
			}
		    
		} catch (\PDOException $e) {
		    error_log('Connection failed: ' . $e->getMessage());
		}
	}

}