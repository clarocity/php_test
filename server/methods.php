<?php

  require_once("config.php");

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

    public function read_by_id($id, $table) {
      $statement = $this->connection->prepare("SELECT * FROM $table WHERE id=$id");
      // binding unnecessary
      if ($statement->execute()) {
        $result = $statement->get_result();
        return $result;
      }
    }

    public function read_join($id) {
      $statement = $this->connection->prepare("SELECT a.id, a.sales_date, a.sales_price FROM sales a JOIN property b ON a.property_id = b.id WHERE a.property_id = $id");
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

    public function sales_create($property_id, $sales_date, $sales_price) {
      $statement = $this->connection->prepare("INSERT INTO sales (property_id, sales_date, sales_price) VALUES ('$property_id', '$sales_date', '$sales_price')");
      $statement->bind_param("ss", $property_id, $sales_date, $sales_price);
      if ($statement->execute()) {
        $statement->close();
        $this->connection->close();
        return true;
      }
    }

    public function update($id, $address, $city, $state, $zip) {
      $statement = $this->connection->prepare("UPDATE property SET address='$address', city='$city', state='$state', zip='$zip' WHERE id=$id");
      $statement->bind_param("ss", $id, $address, $city, $state, $zip);
      if ($statement->execute()) {
        $statement->close();
        $this->connection->close();
        return true;
      }
    }

    public function sales_update($id, $sales_date, $sales_price) {
      $statement = $this->connection->prepare("UPDATE sales SET sales_date='$sales_date', sales_price='$sales_price' WHERE id=$id");
      $statement->bind_param("ss", $id, $sales_date, $sales_price);
      if ($statement->execute()) {
        $statement->close();
        $this->connection->close();
        return true;
      }
    }

    public function delete($id, $table) {
      $statement = $this->connection->prepare("DELETE FROM $table WHERE id=$id");
      if ($statement->execute()) {
        $statement->close();
        $this->connection->close();
        return true;
      }
    }
  }
?>
