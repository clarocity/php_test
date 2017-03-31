<?php

/**
 * Class Property
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

    /**
     * Property constructor
     *
     * @param $property
     */
    public function __construct($property)
    {
        foreach ($property as $key => $value) {
            $this->$key = $value;
        }
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

    public function isValid() {
        return $this->property_valid;
    }

    /**
     * Insert property
     * @throws Exception
     */
    public function insert()
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
    public function modify()
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
    public function delete()
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