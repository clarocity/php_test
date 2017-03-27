<?php

class SaleHistory {

    private $propertyId;
    private $saleHistoryId;
    private $saleDate;
    private $salePrice;

    public function __construct($historyArray) {
        if (is_array($historyArray)) {
            foreach ($historyArray as $key => $item) {
                if (property_exists($this, $key)) {
                    switch ($key) {
                        case 'salePrice' : $this->salePrice = (is_numeric($item)) ? $item : '';
                            break;
                        case 'saleDate' : $data = explode('/', $item);
                            if (3 == count($data)) {
                                list($month, $day, $year) = $data;
                                $this->saleDate = (checkdate($month, $day, $year)) ? $item : '';
                            }
                            break;
                        default: $this->$key = $item;
                    }
                }
            }
        }
    }

    /**
     * Returns array of values for DB
     * @return array()
     */
    public function toArray() {
        $output = array();
        foreach ($this as $key => $value) {
            if (!empty($value)) {
                if ('saleDate' == $key) {
                    list($month, $day, $year) = explode('/', $value);
                    $value = $year . '-' . $month . '-' . $day;
                }
                $output[':' . $key] = $value;
            }
        }
        return $output;
    }

    /**
     * Returns TRUE if property $name is set or return FALSE. If $name is not set return TRUE
     * if all properties are set.
     * @param string $name
     * @return true | false
     */
    public function isValid($name = NULL) {
        if (!$name) {
            return (!empty($this->salePrice) && (!empty($this->saleDate) && !empty($this->propertyId)));
        }
        return !empty($this->$name);
    }

    public function __get($name) {
        if (property_exists($this, $name)) {
            return $this->{$name};
        }
        return NULL;
    }

    public function getInvalidProps() {
        $output = array();
        foreach ($this as $key => $value) {
            if (!$this->isValid($key) && 'saleHistoryId' != $key) {
                $output[] = $key;
            }
        }
        return $output;
    }

}

?>
