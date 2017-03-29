<?php

/**
 * Class Sale
 */

class Sale
{
    protected $db;
    protected $property_id;
    protected $sale_date;
    protected $sale_price;

    /**
     * Sale constructor
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
     * Insert sale
     * @return array
     */
    public function insert() {
        return $this->db->query("INSERT INTO property_sales (property_id, sale_date, sale_price) VALUES ('".$this->property_id."', '".$this->sale_date."', '".$this->sale_price."');");
    }
}