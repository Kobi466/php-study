<?php
require_once (__DIR__ . '/../model/Product.php');
class ProductController{
    private $productModel;
    public function __construct()
    {
        $this->productModel = new Product();
    }
    public function getAllProducts()
    {
        $products = $this->productModel->getAllProducts();
        require_once(__DIR__ . '/../view/ProductList.php');
    }
    public function showFormAddProduct()
    {
        require_once(__DIR__ . '/../view/FormAddProduct.php');
    }
    public function addProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $code = $_POST['code'] ?? '';
            $name = $_POST['name'] ?? '';
            $price = $_POST['price'] ?? '';
            $image = $this->handleImageUpload();
            if ($image === null) {
                $image = 'default.png';
            }
            $this->productModel->addProduct($code, $name, $price, $image);
        }
        header('Location: index.php?action=list');
        exit();
    }
    private function handleImageUpload() {
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $upload_dir = __DIR__ . '/../images/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            $fileType = mime_content_type($_FILES['image']['tmp_name']);

            if (in_array($fileType, $allowedTypes)) {
                $fileExtension = pathinfo(basename($_FILES['image']['name']), PATHINFO_EXTENSION);
                $newFileName = uniqid('product_', true) . '.' . strtolower($fileExtension);
                $target_path = $upload_dir . $newFileName;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
                    return $newFileName;
                }
            }
        }
        return null;
    }
    public function showFormEditProduct()
    {
        $id = $_GET['id'] ?? '';
        if (!$id) {
            header('Location: index.php?action=list');
            exit();
        }
        $product = $this->productModel->getProductById($id);
        require_once(__DIR__ . '/../view/FormEditProduct.php');
    }
    public function editProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? '';
            $code = $_POST['code'] ?? '';
            $name = $_POST['name'] ?? '';
            $price = $_POST['price'] ?? '';
            $oldImage = $_POST['old_image'] ?? 'no_image.png';

            $newImage = $this->handleImageUpload();

            if ($newImage) {
                if ($oldImage !== 'no_image.png' && file_exists(__DIR__ . '/../images/' . $oldImage)) {
                    unlink(__DIR__ . '/../images/' . $oldImage);
                }
                $this->productModel->updateProduct($id, $code, $name, $price, $newImage);
            } else {
                $this->productModel->updateProduct($id, $code, $name, $price, null);
            }
        }
        header('Location: index.php?action=list');
        exit();
    }
    public function deleteProduct()
    {
        $id = $_GET['id'] ?? '';
        if ($id) {
            $product = $this->productModel->getProductById($id);
            if ($product && $this->productModel->deleteProduct($id))
            {
                if (!empty($product['image']) && $product['image'] !== 'no_image.png') {
                    $image_path = __DIR__ . '/../images/' . $product['image'];
                    if (file_exists($image_path)) {
                        unlink($image_path);
                    }
                }
            }
        }
        header('Location: index.php?action=list');
        exit();
    }
}

?>