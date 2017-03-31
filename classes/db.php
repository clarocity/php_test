<?php

/**
 * Class DB
 * Connect to the mysql database using a singleton class
 * $this->db = DB::get_db();
 */

class DB
{

    private static $instance = null;
    private $db;
    private $host = '';
    private $username = '';
    private $password = '';
    private $database = '';

    private function __construct()
    {
        $this->db = new mysqli($this->host, $this->username, $this->password, $this->database);
        if ($this->db->connect_error) {
            throw new Exception("Connection to the mysql database failed: " . $this->db->connect_error);
        }
    }

    public static function connection()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance->db;
    }
}