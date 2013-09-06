<?php

class Property {

    private $propertyId;
    private $address;
    private $city;
    private $zip;
    private $state;
    private $saleHistory;

    public function __construct($propertyArray) {
        if (is_array($propertyArray)) {
            foreach ($propertyArray as $key => $item) {
                if (property_exists($this, $key)) {
                    $this->$key = (('zip' == $key && is_numeric($item) && strlen($item) == 5) || 'zip' != $key) ? $item: '';
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
            if (('saleHistory' != $key) && !empty($value)) $output[':' .$key] = htmlspecialchars ($value);
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
            return (!empty($this->address) && (!empty($this->city) && !empty($this->zip) && !empty($this->state)));
        }
        return !empty($this->$name);
    }

    public function __get($name) {
        if (property_exists($this, $name)) {
            return $this->{$name};
        }
        return NULL;
    }

}

?>
