<?php
namespace Models;

use \PDO as PDO;
use \Config as Config;

class Db {

	private static $db;

	function __construct() {}

	public static function connect(){

		if (!empty(self::$db)) {
			return self::$db;
		}

		try {

			$dsn =  Config::$config['db']['dsn'];
			$user = Config::$config['db']['user'];
			$password = Config::$config['db']['password'];

			self::$db = new PDO($dsn, $user, $password);

			return self::$db;

		} catch (PDOException $e) {

			error_log("Error! : " . $e->getMessage() );
			die();
		}

	}


}