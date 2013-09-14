<?php

/**
 * Class for handling data manipulation
 * 
 */
class DataMapper {

    private $db;

    public function __construct() {
        $config = new ConfigIni();
        if (!$config->getConfigItem('dsn', 'DBconfig') || !$config->getConfigItem('username', 'DBconfig') || !$config->getConfigItem('password', 'DBconfig')) {
            throw new InvalidArgumentException('DB settings not found', 500);
        }

        $this->db = new PDO($config->getConfigItem('dsn', 'DBconfig'), $config->getConfigItem('username', 'DBconfig'), $config->getConfigItem('password', 'DBconfig'));

// I hate default attributes. Bastards.
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Saves instance of property to DB, depending on propertyId we add new or update existing record
     * 
     * @param instance of Property() $property
     * @return integer $lastInsertId
     * @throws Exception
     * @throws InvalidArgumentException
     */
    public function saveProperty($property) {

        if ($property->isValid()) {
            if ($property->propertyId) {
                $query = 'UPDATE property SET address = :address, city = :city, zip = :zip, state = :state WHERE propertyId = :propertyId';
            } else {
                $query = 'INSERT INTO property (address, city, zip, state) VALUES (:address, :city, :zip, :state)';
            }

            $stmt = $this->db->prepare($query);
            $res = $stmt->execute($property->toArray());

            if (!$res) {
                $error = $this->db->errorInfo();
                throw new Exception('Couldnt insert or update record. ErrorInfo was: ' . $error[2] . ' ' . $error[2], $error[0]);
            }
            if ($property->propertyId) {
                return $property->propertyId;
            }
            return $this->db->lastInsertId();
        }
        throw new InvalidArgumentException('Property does not contain valid data');
    }

    /**
     * Returns string of format like " WHERE 1=1 AND property.propertyId=3 AND property.city='Oceanside' ORDER BY property.city, property.zip ASC LIMIT 0,10"
     * where everything is defined by $filter array and $table contains optional table name that is prependent to every column name
     * @param array $filter
     * @param string $table
     */
    private function prepareFilter($filter, $table = '') {
        $where = '';
        $limit = '';
        $order = '';
        $whereArray = array();
        if (is_array($filter)) {

            if (isset($filter['search'])) {
                $where = ' WHERE 1=1 ';
                 foreach ($filter['search'] as $key => $value) {
                    $where .= 'AND ( LOWER(city) REGEXP :city' . $key . ' ';
                    $where .= ' OR zip REGEXP :zip' . $key . ' ';
                    $where .= ' OR LOWER(address) REGEXP :address' . $key . '  ';
                    $where .= ' OR LOWER(state) REGEXP :state' . $key . ' ) ';
                    $whereArray[':city' . $key] = '[[:<:]]' . strtolower($value) . '[[:>:]]';
                    $whereArray[':zip' . $key] = '[[:<:]]' . strtolower($value) . '[[:>:]]';
                    $whereArray[':address' . $key] ='[[:<:]]' . strtolower($value) . '[[:>:]]';
                    $whereArray[':state' . $key] = '[[:<:]]' . strtolower($value) . '[[:>:]]';
                }
            }
            
            if (isset($filter['limit'])) {
                $limit = ' LIMIT ' . $filter['limit']['position'] . ', ' . $filter['limit']['count'];
            }
            if (isset($filter['order'])) {
                $order = ' ORDER BY ';
                foreach ($filter['order']['by'] as $by) {
                    $order .= $by . ', ';
                }

// Drop last comma
                $order = substr($order, 0, -1);
                $order .= $filter['order']['direction'];
            }
        }
        return array('where' => $where . $order . $limit, 'whereArray' => $whereArray);
    }

    /**
     * Returns list of records in property table joined with sale_history according to filtering rules.
     * Should retrive the latest hitory for each record if available.
     * @param array $filter
     * @return type
     */
    public function getProperties($filter = NULL) {
        $filterReady = $this->prepareFilter($filter, 'property');

        $query = "SELECT property.propertyId,
                        property.address,
                        property.zip,
                        property.state,
                        property.city,
                        ph.saleDate,
                        ph.salePrice
                       FROM property
                       LEFT OUTER
                       JOIN 
                       (
                            SELECT sale_history.propertyId, date_format(ph_.saleDate,'%m/%d/%Y') saleDate , salePrice
                            FROM sale_history
                            INNER JOIN 
                            (
                                SELECT propertyId, MAX(saleDate) saleDate
                                FROM sale_history
                                GROUP BY propertyId
                             ) ph_ 
                             ON ph_.propertyId = sale_history.propertyId AND ph_.saleDate = sale_history.saleDate
                        ) ph 
                       ON property.propertyId = ph.propertyId" . $filterReady['where'];
        $stmt = $this->db->prepare($query);
        $result = $stmt->execute($filterReady['whereArray']);
        $properties = array();
        while ($row = $stmt->fetch()) {
            $history = new SaleHistory($row);
            $row['saleHistory'] = array(0 => $history);
            $properties[] = new Property($row);
        }
        return $properties;
    }

    /**
     * Returns array filled with property data and property history in form of 
     *      array('property'=>array('address'=>$address, 'city'=>$city, 'zip'=>$zip, 'state'=>$state, 'propertyId'=>'propertyId'),
     *            'history'=>array(0=>array('salePrice'=>$salePrice, 'saleDate'=>$saleDate)))
     * @param integer | string $propertyId
     * @return array
     */
    public function getProperty($propertyId) {
        // First get property
        $query = 'SELECT * FROM property WHERE propertyId=:propertyId';
        $prop_stmt = $this->db->prepare($query);
        $res = $prop_stmt->execute(array(':propertyId' => $propertyId));

        // Get history
        $query = 'SELECT saleHistoryId, propertyId, salePrice, date_format(saleDate, "%m/%d/%Y") saleDate 
            FROM sale_history 
            WHERE propertyId=:propertyId 
            ORDER BY sale_history.saleDate DESC';
        $hist_stmt = $this->db->prepare($query);
        $res = $hist_stmt->execute(array(':propertyId' => $propertyId));

        // Create array of instances of SaleHostory class
        $historiesArray = $hist_stmt->fetchAll();
        $histories = array();
        if (!empty($historiesArray)) {
            foreach ($historiesArray as $historyArray) {
                $histories[] = new SaleHistory($historyArray);
            }
        }

        // Prepare array for property constructor
        $propertyArray = $prop_stmt->fetch();
        $propertyArray['saleHistory'] = $histories;
        $property = new Property($propertyArray);
        return $property;
    }

    /**
     * Just delete. If there are any errors - let them rise.
     * 
     * @param type $propertyId
     * @return type
     */
    public function deleteProperty($propertyId) {
        $query = 'DELETE FROM property WHERE propertyId = :propertyId';
        $stmt = $this->db->prepare($query);
        return $stmt->execute(array(':propertyId' => $propertyId));
    }

    /**
     * Add information about sale of property to property history (sale_history table)
     * @param instance of SaleHistory() $history
     * @return integer lastInsertId
     * @throws Exception
     */
    public function addSale($history) {
        if ($history->saleHistoryId) {
            // Update existing record
            $query = 'UPDATE sale_history SET propertyId = :propertyId, salePrice = :salePrice, saleDate = :saleDate WHERE saleHistoryId = :saleHistoryId';
        } else {
            //Add new record
            $query = 'INSERT INTO sale_history (propertyId, salePrice, saleDate) VALUES(:propertyId, :salePrice, :saleDate)';
        }
        $stmt = $this->db->prepare($query);
        $res = $stmt->execute($history->toArray());
        if (!$res) {
            throw new Exception('Something wrong ');
        }

        if ($history->saleHistoryId) {
            return $history->saleHistoryId;
        }
        return $this->db->lastInsertId();
    }

    /**
     * Calculates number of records for particular filter, used for pagination
     * @param string $table
     * @param array $filter
     * @return integer
     */
    public function getNumberOfRecords($table, $filter = NULL) {
        // we will count id's, thats good for DB performance
        $idName = $table . 'Id';
        $filterReady = $this->prepareFilter($filter, $table);
        $query = 'SELECT count(' . $idName . ') FROM ' . $table . $filterReady['where'];
        $stmt = $this->db->prepare($query);
        $res = $stmt->execute($filterReady['whereArray']);
        return $stmt->fetchColumn();
    }

}

?>
