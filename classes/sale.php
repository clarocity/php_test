<?php

/**
 * Class Sale
 */
class Sale extends Property
{
    protected $property_id;
    protected $sale_date;
    protected $sale_price;

    /**
     * Sale constructor
     *
     * @param $property
     */
    public function __construct($property)
    {
        if (isset($property)) {
            foreach ($property as $key => $value) {
                $this->$key = $value;
            }
        }
    }

    /**
     * Insert sale using a prepared statement
     *
     * @return array
     * @throws Exception
     */
    public function insert()
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
     *
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