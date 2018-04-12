<?php

  class property {
    public $address;
    public $city;
    public $state;
    public $zip;
    private $connection;

    public function __construct($db) {
      $this->connection = $db;
    }
    // used by table
    function read() {
      // select all data
      $query = "SELECT * FROM property ORDER BY id DESC";
      // $stmt = $this->connection->
    }
  }

?>
