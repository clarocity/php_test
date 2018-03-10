DROP DATABASE IF EXISTS properties_db;

CREATE DATABASE properties_db;
USE properties_db;

CREATE TABLE properties(
  property_id INT NOT NULL AUTO_INCREMENT,
  address TEXT (255) NOT NULL,
  city VARCHAR (255) NOT NULL,
  state VARCHAR (255) NOT NULL,
  zip VARCHAR (255) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE properties_sales(
  sale_id INT NOT NULL AUTO_INCREMENT,
  sale_date VARCHAR (255) NOT NULL,
  sale_price VARCHAR (255) NOT NULL,
  date TIMESTAMP,
  PRIMARY KEY (id),
  FOREIGN KEY (property_id) REFERENCES properties(id)
);

-- new tables

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

DROP TABLE IF EXISTS properties_sales;

CREATE TABLE properties_sales(
  property_id INT NOT NULL,
  sale_id INT NOT NULL AUTO_INCREMENT,
  sale_date VARCHAR (255) NOT NULL,
  sale_price VARCHAR (255) NOT NULL,
  date TIMESTAMP,
  PRIMARY KEY (sale_id),
  FOREIGN KEY (property_id) REFERENCES properties(property_id)
);

INSERT INTO properties_sales (property_id, sale_date, sale_price)
VALUES ("1", "3/3/2018", "$529,000");


INSERT INTO properties_sales (property_id, sale_date, sale_price)
VALUES ("2", "3/3/2018", "$875,000");

INSERT INTO properties_sales (property_id, sale_date, sale_price)
VALUES ("3", "3/4/2018", "$599,999");

INSERT INTO properties (address, city, state, zip)
VALUES ("774 Winston Dr", "San Diego", "CA", "92114");

INSERT INTO properties (address, city, state, zip)
VALUES ("7320 Casper Dr", "San Diego", "CA", "92119");

INSERT INTO properties (address, city, state, zip)
VALUES ("8368 Ivory Coast Dr", "San Diego", "CA", "92126");

SELECT * property_id, sale_id, sale_date, sale_price
  FROM [properties_sales] JOIN properties
    ON [properties_sales].property_id = properties.property_id