<?php
require_once 'config.php';

class Property {
    private $db;
    private $log;
    
    function __construct() {
        $this->db = new mysqli(MYSQLI_HOST,MYSQLI_USER,MYSQLI_PASS,MYSQLI_NAME);
        
        $this->log = new Zend\Log\Logger;
        $this->log->addWriter(new Zend\Log\Writer\Stream('logs/Properties-log'));
    }
    
    /* get list of properties */ 
    public function index() {
        $q = "SELECT p.* , 
                (SELECT COUNT(*) FROM properties_sales WHERE p.id = property_id) as times_sold, 
            	(SELECT sale_price FROM properties_sales WHERE p.id = property_id ORDER BY sale_date DESC LIMIT 1) AS last_sale
                FROM properties AS p 
                ORDER BY address";
        $result = $this->db->query($q);
        if($result) {
            $rows = [];
            while($row = $result->fetch_assoc()) $rows[] = $row;
            return $rows;
        }
        return false;
    }
    
    public function salesList($id = null) {
        if($id) {
            $q = "SELECT p.address, ps.sale_date, ps.sale_price FROM properties_sales AS ps 
                    INNER JOIN properties AS p ON ps.property_id = p.id
                    WHERE property_id = '{$id}' 
                    ORDER BY sale_date DESC;";
            $result = $this->db->query($q);
            if($result) {
                $rows = [];
                while($row = $result->fetch_assoc()) $rows[] = $row;
                return $rows;
            }
            return false;
        }
        return false;
    }
    
    /* insert new property */
    public function create($fields = null) {
        if($fields) {
            $result = $this->db->query("INSERT INTO properties(address, city, state, zip) 
                                        VALUES('{$_POST['address']}', '{$_POST['city']}', '{$_POST['state']}', '{$_POST['zip']}')");
            if($result) { $this->log->info("New Property Added - ID#: ".$this->db->insert_id); }
            return ($result) ? $this->db->insert_id : false;
        }
        return false;
    }
    
    /* read single property */
    public function read($id = null) {
        if($id) {
            $result = $this->db->query("SELECT * FROM properties WHERE `id` = '{$id}'");
            return $result ? $result->fetch_assoc() : false; 
        }
        return false;
    }
    
    /* update property */
    public function update($fields = null) {
        if($fields) {
            $result = $this->db->query("UPDATE properties 
                                        SET address = '{$_POST['address']}', 
                                        city = '{$_POST['city']}', 
                                        state = '{$_POST['state']}', 
                                        zip = '{$_POST['zip']}' 
                                        WHERE id='{$_POST['id']}'");
            if($result) { $this->log->info("Property Edited - ID#: ".$_POST['id']); }
            return $result;
        }
        return false;
    }
    
    /* delete property */
    public function delete($id = null) {
        if($id) {
            $result = $this->db->query("DELETE FROM properties WHERE id='{$id}'");
            if($result) { $this->log->info("Property Deleted - ID#: ".$id); }
            return $result;
        }
        return false;
    }
}