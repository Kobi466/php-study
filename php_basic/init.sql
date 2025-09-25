-- Tạo database nếu chưa tồn tại và sử dụng bộ ký tự utf8mb4 để hỗ trợ tiếng Việt tốt nhất
CREATE DATABASE IF NOT EXISTS `lab5` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Chuyển sang sử dụng database vừa tạo
USE `lab5`;

-- Tạo bảng `products`
CREATE TABLE IF NOT EXISTS `products` (
  `productID` INT AUTO_INCREMENT PRIMARY KEY,
  `productCode` VARCHAR(255) NOT NULL UNIQUE,
  `productName` VARCHAR(255) NOT NULL,
  `listPrice` DECIMAL(10, 2) NOT NULL,
  `image` VARCHAR(255) NULL DEFAULT 'no_image.png'
) ENGINE=InnoDB;