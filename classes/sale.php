<?php

/**
 * Sale Class
 */
class Sale extends Property
{
    protected $property_id;
    protected $sale_date;
    protected $sale_price;
    protected $action;

    /**
     * Sale constructor
     * @param $property
     */
    public function __construct($property)
    {
        $this->make_globals($property);
        if ($this->property_id) $this->isNumeric($this->property_id);
        if ($this->action == 'add') $this->insert_sale();
    }

    /**
     * Write $property to $this
     * I use this to pass in $_GET or $_POST to the obj
     * @param $property
     */
    private function make_globals($property) {
        foreach ($property as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Insert Sale Wrapper
     */
    private function insert_sale() {
        $this->insert_record();
        header('Location: view.php?property_id='.$_POST['property_id']);
        exit;
    }

    /**
     * Insert sale using a prepared statement
     * @return array
     * @throws Exception
     */
    private function insert_record()
    {
            $stmt = DB::connection()->prepare("INSERT INTO property_sales (property_id, sale_date, sale_price) VALUES (?, ?, ?)");

            // Handle Prepare Errors
            if ($stmt === false) {
                throw new Exception(DB::connection()->error);
            }

            $stmt->bind_param("iss", $this->property_id, $this->sale_date, $this->sale_price);
            $stmt->execute();
    }

    /**
     * Get all property sales
     * @return array
     * @throws Exception
     */
    public function get_property_sales()
    {
        $result = array();
        $results = array();
        $stmt = DB::connection()->prepare("SELECT property_id, sale_date, sale_price FROM property_sales WHERE property_id = ?");

        // Handle Prepare Errors
        if ($stmt === false) {
            throw new Exception(DB::connection()->error);
        }

        $stmt->bind_param("i", $this->property_id);
        $stmt->execute();
        $stmt->bind_result($result['property_id'], $result['sale_date'], $result['sale_price']);

        // Stuff the results into an array
        while ($stmt->fetch()) {
            $results[] = array('property_id' => $result['property_id'], 'sale_date' => $result['sale_date'], 'sale_price' => $result['sale_price']);
        }
        $stmt->close();
        return $results;
    }
}