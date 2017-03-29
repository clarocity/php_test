<?php
// Load classes into the global space
include $_SERVER["DOCUMENT_ROOT"].'/classes/db.php';
include $_SERVER["DOCUMENT_ROOT"].'/classes/property.php';
include $_SERVER["DOCUMENT_ROOT"].'/classes/properties.php';
include $_SERVER["DOCUMENT_ROOT"].'/classes/sale.php';

// Create a database instance
// I don't believe I take the right approach when extending the database.
// I ran out of time before I could address.
$db = new DB;

// Create a properties instance
// Not sure if it's the right approach to extend the db this way, but ran out of time.
$properties = new Properties($db);