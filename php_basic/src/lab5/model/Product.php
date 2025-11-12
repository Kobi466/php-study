<?php
require_once(__DIR__ . '/../config/Database.php');
class Product
{
    private $instance;
    private $table = 'products';

    public function __construct()
    {
        // Lấy đối tượng PDO thông qua Singleton đã được tái cấu trúc
        $this->instance = Database::getInstance()->getConnection();
    }
    public function getAllProducts()
    {
        $stmt = $this->instance->prepare("SELECT * FROM " . $this->table . " ORDER BY productID DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getProductById($id)
    {
        $stmt = $this->instance->prepare("SELECT * FROM " . $this->table . " WHERE productID = :id LIMIT 1");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT );
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function addProduct($code, $name, $price, $image) {
        $query = 'INSERT INTO ' . $this->table . ' (productCode, productName, listPrice, image) VALUES (:code, :name, :price, :image)';
        $stmt = $this->instance->prepare($query);
        $stmt->bindParam(':code', $code);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':image', $image);
        return $stmt->execute();
    }

    public function updateProduct($id, $code, $name, $price, $image = null) {
        $query = 'UPDATE ' . $this->table . ' SET productCode = :code, productName = :name, listPrice = :price';
        if ($image) {
            $query .= ', image = :image';
        }
        $query .= ' WHERE productID = :id';

        $stmt = $this->instance->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':code', $code);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        if ($image) {
            $stmt->bindParam(':image', $image);
        }
        return $stmt->execute();
    }

    public function deleteProduct($id) {
        $query = 'DELETE FROM ' . $this->table . ' WHERE productID = :id';
        $stmt = $this->instance->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>
