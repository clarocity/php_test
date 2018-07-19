<?php
namespace Models;

use \PDO as PDO;

class Model {

	public $db;

	function __construct() {

		$dsn = 'mysql:dbname=testdb;host=127.0.0.1';
		$user = 'root';
		$password = 'kaos29';

		try {
		    $this->db = new PDO($dsn, $user, $password);
		} catch (\PDOException $e) {
		    error_log('Connection failed: ' . $e->getMessage());
		}
	}

}