<?php

  class Database {
    private $databaseHost = 'localhost';
    private $databaseName = 'property';
    private $databaseUser = 'root';
    private $databasePassword = '';
    public $connection;

    public function __construct() {
      $this->connection->connect();
    }

    public function connect() {
      $this->connection = new mysqli($this->databaseHost, $this->databaseUser, $this->databasePassword, $this->databaseName);
    }
  }

?>
