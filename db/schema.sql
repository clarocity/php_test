DROP DATABASE IF EXISTS properties_db;

CREATE DATABASE properties_db;
USE properties_db;

CREATE TABLE properties(
  id INT NOT NULL AUTO_INCREMENT,
  address TEXT (65535) NOT NULL,
  city VARCHAR (255) NOT NULL,
  state VARCHAR (255) NOT NULL,
  zip VARCHAR (255) NOT NULL,
  sale_date VARCHAR (255) NOT NULL,
  sale_price VARCHAR (255) NOT NULL,
  date TIMESTAMP,
  PRIMARY KEY (id)
);