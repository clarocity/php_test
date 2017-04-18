<?php

class Property {
    
    protected $pdo;
    protected $data = array();

    public function __construct(PDO $pdo, $id = null){
        $this->pdo = $pdo;
        if ($id){
            $this->data["id"] = $id;
        }
    }

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function get($name)
    {
        if (isset($this->data[$name])) {
            return $this->data[$name];
        } else {
            return false;
        }
    }

    public function getSales() {
        $query = "SELECT * FROM sales WHERE property_id = :id ORDER BY sale_date desc";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":id", $this->data['id'], PDO::PARAM_INT);
        $stmt->execute();
        $array = [];
        return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findOne($id){
        $query = "SELECT * FROM properties WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        if(is_object($result)){
            foreach($result as $key => $value){
                $this->data[$key] = $value;
            }
            return $this->data;
        } else {
            echo "<div class='alert alert-danger' role='alert'>Error found.</div>";
            die();
        }
    }

    public function delete($id){
        $query = "DELETE FROM properties WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        if(count($result) > 0){
            return "Property record deleted from database.";
        } else {
            return "An error occurred.";
        }
    }

    public function update(){
        $query = "UPDATE properties SET address = :address, city = :city, state = :state, zip = :zip WHERE id=:id;";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":address", $this->data["address"]);
        $stmt->bindValue(":city", $this->data["city"]);
        $stmt->bindValue(":state", $this->data["state"]);
        $stmt->bindValue(":zip", $this->data["zip"]);
        $stmt->bindValue(":id", $this->data["id"]);
        $stmt->execute();
        $result = $stmt->fetch();
        echo '<p class="alert-success">Property has been updated.</p>';
    }

    public function __toString()
    {
        $output =  $this->data['address'] . ", ";
        $output .= $this->data['city'] . ", " . $this->data['state'] . " ";
        $output .= $this->data['zip'];
        return $output;
    }

} 

?>