<?php

  require_once("./config.php");

  class Methods extends Database {

    public function __construct() {
      $this->connect();
    }

    public function read() {
      $statement = $this->connection->prepare("SELECT * FROM property ORDER BY id DESC");
      if ($statement->execute()) {
        $result = $statement->get_result();
        return $result;
      }
    }

    public function create($address, $city, $state, $zip) {
      $statement = $this->connection->prepare("INSERT INTO property (address, city, state, zip) VALUES ('$address', '$city', '$state', '$zip')");
      $statement->bind_param("ss", $address, $city, $state, $zip);
      if ($statement->execute()) {
        $statement->close();
        $this->connection->close();
        return true;
      }
    }

  }
?>
