<?php

// Sat April 1 - I'm working on this code right now. 

// Start a session to handle CSRF
session_start();

// Load classes into the global space
include $_SERVER["DOCUMENT_ROOT"].'/classes/db.php';
include $_SERVER["DOCUMENT_ROOT"].'/classes/properties.php';
include $_SERVER["DOCUMENT_ROOT"].'/classes/property.php';
include $_SERVER["DOCUMENT_ROOT"].'/classes/sale.php';

// Generate a CSRF token
// See Property->insert();
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}

// Create a second token for hash_hmac() congruent operation
if (empty($_SESSION['second_token'])) {
    $_SESSION['second_token'] = bin2hex(random_bytes(32));
}

// CHANGE LOG
// Corrected Object Inheritances
// Moved database connection to singleton class
// DB calls use prepared statements
// Added over the top CSRF protection - Bulletproof?
// Added error handling for prepared statements - Possible room for improvement
// Properties class is now static
// Sales class extends Property for proper OOP design
// Added jQuery validation and looks pretty with bootstrap. /js/validate/
// Small views cleanup

/*
DROP TABLE IF EXISTS `property`;
CREATE TABLE `property` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `address` varchar(255) NOT NULL,
  `city` varchar(20) NOT NULL,
  `state` varchar(20) NOT NULL,
  `zip` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `property_sales`;
CREATE TABLE `property_sales` (
`property_id` int(11) NOT NULL,
  `sale_date` date NOT NULL,
  `sale_price` float NOT NULL,
  KEY `property_id` (`property_id`),
  CONSTRAINT `property_sales_ibfk_2` FOREIGN KEY (`property_id`) REFERENCES `property` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
*/
