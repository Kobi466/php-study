CREATE DATABASE IF NOT EXISTS `lab5` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE `lab5`;

CREATE TABLE IF NOT EXISTS `products` (
                                          `productID` INT AUTO_INCREMENT PRIMARY KEY,
                                          `productCode` VARCHAR(255) NOT NULL UNIQUE,
    `productName` VARCHAR(255) NOT NULL,
    `listPrice` DECIMAL(10, 2) NOT NULL,
    `image` VARCHAR(255) NULL DEFAULT 'no_image.png'
    ) ENGINE=InnoDB;


-- Create the database
DROP DATABASE IF EXISTS my_guitar_shop1;
CREATE DATABASE my_guitar_shop1;
USE my_guitar_shop1;

-- Create the tables
CREATE TABLE categories (
  categoryID INT(11) NOT NULL AUTO_INCREMENT,
  categoryName VARCHAR(255) NOT NULL,
  PRIMARY KEY (categoryID)
);

CREATE TABLE products (
  productID INT(11) NOT NULL AUTO_INCREMENT,
  categoryID INT(11) NOT NULL,
  productCode VARCHAR(10) NOT NULL,
  productName VARCHAR(255) NOT NULL,
  listPrice DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (productID),
  FOREIGN KEY (categoryID) REFERENCES categories(categoryID)
);

-- Insert data into the tables
INSERT INTO categories (categoryName) VALUES
('Guitars'),
('Basses'),
('Drums');

INSERT INTO products (categoryID, productCode, productName, listPrice) VALUES
(1, 'strat', 'Fender Stratocaster', '699.99'),
(1, 'les_paul', 'Gibson Les Paul', '1199.99'),
(1, 'sg', 'Gibson SG', '2517.50'),
(1, 'fg700s', 'Yamaha FG700S', '489.99'),
(1, 'washburn', 'Washburn D10S', '299.00'),
(1, 'rodriguez', 'Rodriguez Caballero 11', '415.00'),
(2, 'precision', 'Fender Precision Bass', '799.99'),
(2, 'hofner', 'Hofner Icon', '499.99'),
(3, 'ludwig', 'Ludwig 5-piece Drum Set with Cymbals', '699.99'),
(3, 'tama', 'Tama 5-Piece Drum Set with Cymbals', '799.99');
