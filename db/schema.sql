DROP DATABASE IF EXISTS properties_db;

CREATE DATABASE properties_db;
USE properties_db;

CREATE TABLE properties(
  property_id INT NOT NULL AUTO_INCREMENT,
  address TEXT (255) NOT NULL,
  city VARCHAR (255) NOT NULL,
  state VARCHAR (255) NOT NULL,
  zip VARCHAR (255) NOT NULL,
  PRIMARY KEY (property_id)
);

CREATE TABLE properties_sales(
  property_id INT NOT NULL,
  sale_id INT NOT NULL AUTO_INCREMENT,
  sale_date VARCHAR (255) NOT NULL,
  sale_price VARCHAR (255) NOT NULL,
  date TIMESTAMP,
  PRIMARY KEY (sale_id),
  FOREIGN KEY (property_id) REFERENCES properties(property_id)
);

SELECT *
  FROM properties_sales JOIN properties
    ON properties_sales.property_id = properties.property_id