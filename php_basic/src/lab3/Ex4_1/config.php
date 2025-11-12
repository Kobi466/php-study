<?php
$host = 'db';
$user = 'root';
$pass = 'root';
$db = 'lab3';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS categories (
            categoryID INT PRIMARY KEY AUTO_INCREMENT,
            categoryName VARCHAR(255) NOT NULL
        )
    ");

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS products (
            productID INT PRIMARY KEY AUTO_INCREMENT,
            categoryID INT NOT NULL,
            productCode VARCHAR(50) NOT NULL,
            productName VARCHAR(255) NOT NULL,
            listPrice DECIMAL(10,2) NOT NULL,
            FOREIGN KEY (categoryID) REFERENCES categories(categoryID)
        )
    ");
    // Dem nếu rỗng add thêm 3 phần tử vào là 3 sản phẩm
    $stmt = $pdo->query("SELECT COUNT(*) FROM categories");
    if ($stmt->fetchColumn() == 0) {
        $pdo->exec("INSERT INTO categories (categoryName) VALUES ('Guitars'), ('Basses'), ('Drums')");
    }

} catch (PDOException $e) {
    die("DB Connection failed: " . $e->getMessage());
}
?>