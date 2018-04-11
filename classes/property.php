<?php
  class property {
    var $address;
    var $city;
    var $state;
    var $zip;
    function __construct($property_address, $city) {
      $this->address = $property_address;
      $this->city = $city;
    }
    function set_address($new_address, $city) {
      $this->address = $new_address;
      $this->city = $city;
    }
    function get_info() {
      return $this->address.$this->city;

    }
  }
?>
