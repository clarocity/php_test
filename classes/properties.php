<?php

/**
 * Properties Class
 */

class Properties
{
    private static $pagination_limit = 5;

    /**
     * Get recent properties
     *
     * @return array
     */
    public static function get_recent()
    {
        $result = array();
        $results = array();

        $stmt = DB::connection()->prepare("SELECT a.id, a.address, a.city, a.state, a.zip, count(b.sale_date) as sale_count FROM property AS a LEFT OUTER JOIN property_sales AS b ON b.property_id= a.id GROUP BY a.id ORDER BY a.id desc limit 5");

        if ($stmt === false) {
            throw new Exception(DB::connection()->error);
        }

        $stmt->execute();
        $stmt->bind_result($result['id'], $result['address'], $result['city'], $result['state'], $result['zip'], $result['sale_count']);
        while ($stmt->fetch()) {
            $results[] = array('id' => $result['id'], 'address' => $result['address'], 'city' => $result['city'], 'state' => $result['state'], 'zip' => $result['zip'], 'sale_count' => $result['sale_count']);
        }
        $stmt->close();
        return $results;

    }

    /**
     * Get top selling properties
     *
     * @return array
     */
    public static function get_top_selling()
    {
        $result = array();
        $results = array();
        $stmt = DB::connection()->prepare("SELECT a.id, a.address, a.city, a.state, a.zip, count(b.sale_date) as sale_count FROM property AS a LEFT OUTER JOIN property_sales AS b ON b.property_id= a.id GROUP BY a.id ORDER BY sale_count  desc limit 5");

        if ($stmt === false) {
            throw new Exception(DB::connection()->error);
        }

        $stmt->execute();
        $stmt->bind_result($result['id'], $result['address'], $result['city'], $result['state'], $result['zip'], $result['sale_count']);
        while ($stmt->fetch()) {
            $results[] = array('id' => $result['id'], 'address' => $result['address'], 'city' => $result['city'], 'state' => $result['state'], 'zip' => $result['zip'], 'sale_count' => $result['sale_count']);
        }
        $stmt->close();
        return $results;
    }

    /**
     * Get all properties
     *
     * @return array
     */
    public static function get_properties($page)
    {
        $i = 0;
        $result = array();
        $results = array();

        if ($page == 0) $offset = 0;
        else $offset = $page * self::$pagination_limit - self::$pagination_limit;

        $stmt = DB::connection()->prepare("SELECT a.id, a.address, a.city, a.state, a.zip, count(b.sale_date) as sale_count, (SELECT COUNT(id) FROM property) as ttl_props FROM property AS a LEFT OUTER JOIN property_sales AS b ON b.property_id= a.id GROUP BY a.id ORDER BY a.id desc LIMIT ".$offset.", ".self::$pagination_limit);

        if ($stmt === false) {
            throw new Exception(DB::connection()->error);
        }

        $stmt->execute();
        $stmt->bind_result($result['id'], $result['address'], $result['city'], $result['state'], $result['zip'], $result['sale_count'], $result['ttl_props']);

        while ($stmt->fetch()) {
            $results['results'][$i] = array('id' => $result['id'], 'address' => $result['address'], 'city' => $result['city'], 'state' => $result['state'], 'zip' => $result['zip'], 'sale_count' => $result['sale_count']);
            $results['ttl_props'] = $result['ttl_props'];
            $results['ttl_pages'] = ceil($result['ttl_props'] /  self::$pagination_limit);
            $i++;
        }
        $stmt->close();
        return $results;
    }

    /**
     * Get the latest sales of all properties
     *
     * @return array
     */
    public static function get_latest_sales()
    {
        $result = array();
        $results = array();
        $stmt = DB::connection()->prepare("SELECT p.id, p.address, p.city, p.state, p.zip, s.sale_price, s.sale_date FROM property p LEFT JOIN property_sales s ON p.id = s.property_id Where s.sale_date IS NOT NULL ORDER BY s.sale_date desc limit 5");

        if ($stmt === false) {
            throw new Exception(DB::connection()->error);
        }

        $stmt->execute();
        $stmt->bind_result($result['id'], $result['address'], $result['city'], $result['state'], $result['zip'], $result['sale_price'], $result['sale_date']);
        while ($stmt->fetch()) {
            $results[] = array('id' => $result['id'], 'address' => $result['address'], 'city' => $result['city'], 'state' => $result['state'], 'zip' => $result['zip'], 'sale_price' => $result['sale_price'], 'sale_date' => $result['sale_date']);
        }
        $stmt->close();
        return $results;
    }
}