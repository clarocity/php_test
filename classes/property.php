<?php

/**
 * Property Class
 */
class Property
{
    protected $property_id;
    protected $property_valid;
    protected $address;
    protected $city;
    protected $state;
    protected $zip;
    protected $csrf_token;
    protected $token;
    protected $action;

    /**
     * Property constructor
     *
     * @param $property
     */
    public function __construct($property)
    {
        $this->make_globals($property);
        if ($this->property_id) $this->isNumeric($this->property_id);
        if ($this->action == 'add') $this->insert_property();
        if ($this->action == 'modify') $this->modify_property();
        if ($this->action == 'delete') $this->delete_property();
    }

    /**
     * Write $property to $this
     * @param $property
     */
    public function make_globals($property) {
        foreach ($property as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Insert Property Wrapper
     */
    public function insert_property() {
        $this->property_id = $this->insert_record();
        header('Location: /property/view.php?property_id='.$this->property_id.'&added=true');
        exit;
    }

    /**
     * Delete Property Wrapper
     */
    public function delete_property() {
        $this->delete_record();
        header('Location: /property?deleted=true');
        exit;
    }

    /**
     * Modify Property Wrapper
     */
    public function modify_property() {
        $this->modify_record();
    }

    /**
     * Ensure $this->property_id is numeric
     * @throws Exception
     */
    public function isNumeric($property_id) {
        if (!is_numeric($property_id)) {
            throw new Exception("Property ID needs to be numeric.");
        }
    }

    /**
     * Ensure the property is valid
     * @return mixed
     */
    public function isValid() {
        return $this->property_valid;
    }

    /**
     * Get a property
     * @throws Exception
     */
    public function get_property()
    {
            $stmt = DB::connection()->prepare("SELECT id, address, city, state, zip FROM property where id = ?");

            if ($stmt === false) {
                throw new Exception(DB::connection()->error);
            }

            $stmt->bind_param("i", $this->property_id);
            $stmt->execute();
            $stmt->bind_result($this->property_id, $this->address, $this->city, $this->state, $this->zip);
            if ($stmt->field_count) {
                $stmt->store_result();
                $this->property_valid = $stmt->num_rows();
            }
            $stmt->fetch();
            $stmt->close();
    }

    /**
     * Insert property
     * @throws Exception
     */
    public function insert_record()
    {
            $this->security('/add.php');
            $stmt = DB::connection()->prepare("INSERT INTO property (address, city, state, zip) VALUES (?, ?, ?, ?)");

            if ($stmt === false) {
                throw new Exception(DB::connection()->error);
            }

            $stmt->bind_param("sssi", $this->address, $this->city, $this->state, $this->zip);
            $stmt->execute();
            $return_data = $stmt->insert_id;
            $stmt->close();
            return $return_data;
    }

    /**
     * Modify property
     * @throws Exception
     */
    public function modify_record()
    {
            $this->security('/modify.php');
            $stmt = DB::connection()->prepare("UPDATE property SET address = ?, city = ?, state = ?, zip = ? WHERE id = ?");

            if ($stmt === false) {
                throw new Exception(DB::connection()->error);
            }

            $stmt->bind_param("sssii", $this->address, $this->city, $this->state, $this->zip, $this->property_id);
            $stmt->execute();
            $stmt->close();
    }

    /**
     * Delete property
     * @throws Exception
     */
    public function delete_record()
    {
            $this->security('/view.php');
            $stmt = DB::connection()->prepare("DELETE FROM property WHERE id = ?");

            if ($stmt === false) {
                throw new Exception(DB::connection()->error);
            }

            $stmt->bind_param("i", $this->property_id);
            $stmt->execute();
            $stmt->close();
    }

    /**
     * Cross Site Request Forgery Protection
     * Might be over the top...
     * @param $page - url of form page
     * @throws Exception
     */
    public function security($page)
    {
        // Ensure form CSRF token equals session CSRF token
        if (!hash_equals($_SESSION['token'], $this->csrf_token)) {
            die("Cross Site Scripting Detected");
        }

        // Generate a keyed hash value using the HMAC method for per form lock down
        // Restrict tokens to only be available for a particular form
        // https://secure.php.net/hash_hmac
        $hash = hash_hmac('sha256', $page, $_SESSION['second_token']);
        if (!hash_equals($hash, $this->token)) {
            die("Cross Site Scripting Detected");
        }
    }


    /**
     * Get sales for a property
     *
     * @return array
     */
    public function get_property_sales() {
        $sale_obj = new Sale($_GET);
        $sales = $sale_obj->get_property_sales();
        return $sales;
    }
    /**
     * Get the id of the property
     *
     * @return string
     */
    public function get_id()
    {
        return $this->property_id;
    }

    /**
     * Get the address of the property
     *
     * @return string
     */
    public function get_address()
    {
        return $this->address;
    }

    /**
     * Get the city of the property
     *
     * @return string
     */
    public function get_city()
    {
        return $this->city;
    }

    /**
     * Get the state of the property
     *
     * @return string
     */
    public function get_state()
    {
        return $this->state;
    }

    /**
     * Get the zip of the property
     *
     * @return string
     */
    public function get_zip()
    {
        return $this->zip;
    }
}