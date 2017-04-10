<?php

class PropertyList {

    private $pdo;
    private $query = "SELECT * FROM properties ";
    private $year;
    private $priceRange;        
    private $against;

    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    public function setAgainst($against){
        $this->against = $against;
    }

    public function setYear($year){
        $this->year = $year;
    }

    public function __get($name){
        if (isset($this->data[$name])) {
            return $this->data[$name];
        } else {
            return false;
        }
    }

    public function setPriceRange($priceRange){
        $this->priceRange = $priceRange;
    }

    public function addProperty(Property $property){
        $createquery = "INSERT INTO properties (address,city,state,zip) ";
        $createquery .= "VALUES ('". $property->get('address');
        $createquery .= "', '". $property->get('city'). "', '" . $property->get('state'). "', '". $property->get('zip'). "');";
        $stmt = $this->pdo->prepare($createquery);
        $result = $stmt->execute();
        if ($result){
            echo '<p class="alert-success">New property added.</p>';
        } else {
            echo '<p class="alert-danger">Error occurred. New property was not added.</p>';
        }
    }

    public function findAll(){
        if (isset($this->year)|| isset($this->priceRange)){
            $this->query = " 
                SELECT a.*, c.* 
                FROM properties a
                INNER JOIN sales c
                    ON a.id = c.property_id
                Inner JOIN
                    (
                        SELECT property_ID, MAX(sale_date) maxDate
                        FROM sales
                        GROUP BY property_ID
                    ) b 
                    ON c.property_id = b.property_id AND
                        c.sale_date = b.maxDate
                WHERE 
                    MATCH (address, city, state, zip) 
                    AGAINST (\"{$this->against}\" IN NATURAL LANGUAGE MODE)";
            if (isset($this->year)){
                $this->query .= " AND YEAR(sale_date) = \"{$this->year}\" ";
            }
            if (isset($this->priceRange)){
                $this->query .= "AND sale_price {$this->priceRange} ";
            }
            $this->query .= ";";
        } else if ($this->against !== ""){
            $this->query .= "WHERE MATCH (address, city, state, zip) ";
            $this->query .= "AGAINST (\"{$this->against}\" IN NATURAL LANGUAGE MODE) ";
        }
        $stmt = $this->pdo->prepare($this->query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
        
} 

?>