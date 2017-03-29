<?php

/**
 * Class Properties
 */

class Properties
{
    protected $db;

    /**
     * Properties constructor
     *
     * @param $db
     */
    public function __construct($db) {
        $this->db = $db;
    }

    /**
     * Get most recent properties
     * @return array
     */
    public function get_recent_properties() {
        return $this->db->query('SELECT a.id, a.address, a.city, a.state, a.zip, count(b.sale_date) as sale_count FROM property AS a LEFT OUTER JOIN property_sales AS b ON b.property_id= a.id GROUP BY a.id ORDER BY a.id desc limit 5');
    }

    /**
     * Get top selling properties
     * @return array
     */
    public function get_top_selling() {
        return $this->db->query('SELECT a.id, a.address, a.city, a.state, a.zip, count(b.sale_date) as sale_count FROM property AS a LEFT OUTER JOIN property_sales AS b ON b.property_id= a.id GROUP BY a.id ORDER BY sale_count  desc limit 5');
    }

    /**
     * Get all properties
     * todo add pagination
     * @return array
     */
    public function get_properties() {
        return $this->db->query('SELECT a.id, a.address, a.city, a.state, a.zip, count(b.sale_date) as sale_count FROM property AS a LEFT OUTER JOIN property_sales AS b ON b.property_id= a.id GROUP BY a.id ORDER BY a.id desc limit 100');
    }

    /**
     * Get the latest sales of all properties
     * @return mixed
     */
    public function get_latest_sales() {
        return $this->db->query('SELECT p.id, p.address, p.city, p.state, p.zip, s.sale_price, s.sale_date FROM property p LEFT JOIN property_sales s ON p.id = s.property_id Where s.sale_date IS NOT NULL ORDER BY s.sale_date desc limit 5');
    }

}