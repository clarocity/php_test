<?php

/**
 * Class DB
 * Simple class to connect to the mysql database
 * Didn't have enough time to expand outside of project requirements
 */

class DB
{

    private $host = '';
    private $username = '';
    private $password = '';
    private $database = '';
    private $conn;
    protected $db;

    /**
     * Constructor to load the database
     */
    public function __construct(){
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
        if ($this->conn->connect_error) {
            die("Connection to the mysql database failed: " . $this->conn->connect_error);
        }
    }

    /**
     * Query MySQL and return the results in an array
     * @param $sql
     * @return array
     */
    public function query($sql) {
        $results = $this->conn->query($sql);
        if(is_object($results)){
            while ($row = $results->fetch_object()){
                $ret_arr[] = $row;
            }
            $results->close();
        }
        if (isset($ret_arr) && is_array($ret_arr)) return $ret_arr;
    }

    /**
     * Close the database connection
     * Had problems here at the end when optimizing db stuff
     */
    public function __destruct() {
        //$this->conn->close();
    }
}
?>