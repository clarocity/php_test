<?php

/**
 * Class Property
 */

class Property
{
    protected $db;
    private $id;
    private $address;
    private $city;
    private $state;
    private $zip;

    /**
     * Property constructor
     *
     * @param $db
     * @param $property
     */
    public function __construct($db, $property) {
        $this->db = $db;
        if (isset($property)) {
            foreach ($property as $key => $value) {
                $this->$key = $value;
            }
        }
    }

    /**
     * Get the id of the property
     * @return string
     */
    public function get_id() {
        return $this->id;
    }

    /**
     * Get the address of the property
     * @return string
     */
    public function get_address() {
        return $this->address;
    }

    /**
     * Get the city of the property
     * @return string
     */
    public function get_city() {
        return $this->city;
    }

    /**
     * Get the state of the property
     * @return string
     */
    public function get_state() {
        return $this->state;
    }

    /**
     * Get the zip of the property
     * @return string
     */
    public function get_zip() {
        return $this->zip;
    }

    /**
     * Get a property
     * @return array
     */
    public function get_property() {
        $property = $this->db->query('SELECT * FROM property where id = ' . $this->id);
        foreach ($property[0] as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Insert property
     * @return array
     */
    public function insert() {
        return $this->db->query("INSERT INTO property (address, city, state, zip) VALUES ('".$this->address."', '".$this->city."', '".$this->state."', '".$this->zip."')");
    }

    /**
     * Modify property
     * @return mixed
     */
    public function modify() {
        return $this->db->query("UPDATE property SET address = '".$this->address."', city = '".$this->city."', state = '".$this->state."', zip = '".$this->zip."' WHERE id = '".$this->id."'");
    }

    /**
     * Delete property
     * @return mixed
     */
    public function delete() {
        return $this->db->query('delete FROM property where id = ' . $this->id);
    }

    /**
     * Get all property sales
     * @return array
     */
    public function get_property_sales() {
        return $this->db->query('SELECT * FROM property_sales where property_id = ' . $this->id . ' ORDER BY sale_date desc');
    }
}

