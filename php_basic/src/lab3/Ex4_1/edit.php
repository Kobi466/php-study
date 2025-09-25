<?php
include 'config.php';

$error_message = '';
$success_message = '';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: list.php");
    exit;
}

$product_id = (int)$_GET['id'];

if (!empty($pdo)) {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE productID = ?");
}
$stmt->execute([$product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    header("Location: list.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $category_id = $_POST['category_id'];
        $code = trim($_POST['code']);
        $name = trim($_POST['name']);
        $price = (float)$_POST['price'];

        if (empty($code) || empty($name) || $price <= 0) {
            throw new Exception("Vui lòng điền đầy đủ thông tin sản phẩm.");
        }

        $stmt = $pdo->prepare("UPDATE products 
                              SET categoryID = ?, productCode = ?, productName = ?, listPrice = ? 
                              WHERE productID = ?");
        $stmt->execute([$category_id, $code, $name, $price, $product_id]);

        $success_message = "Cập nhật sản phẩm thành công!";
        
        $product['categoryID'] = $category_id;
        $product['productCode'] = $code;
        $product['productName'] = $name;
        $product['listPrice'] = $price;
        
    } catch (Exception $e) {
        $error_message = $e->getMessage();
    }
}

// Lấy danh sách danh mục
$categories = $pdo->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sửa sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h4>Sửa sản phẩm</h4>
                    </div>
                    <div class="card-body">
                        <a href="list.php" class="btn btn-secondary mb-3">← Quay lại</a>
                        
                        <?php if ($error_message): ?>
                            <div class="alert alert-danger"><?= $error_message ?></div>
                        <?php endif; ?>
                        
                        <?php if ($success_message): ?>
                            <div class="alert alert-success">
                                <?= $success_message ?>
                                <a href="list.php" class="alert-link">Xem danh sách</a>
                            </div>
                        <?php endif; ?>
                        
                        <form method="post" class="mt-3">
                            <div class="mb-3">
                                <label class="form-label">Danh mục</label>
                                <select name="category_id" class="form-select" required>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?= $category['categoryID'] ?>"
                                            <?= $category['categoryID'] == $product['categoryID'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($category['categoryName']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Mã sản phẩm</label>
                                <input type="text" name="code" class="form-control" required 
                                       value="<?= htmlspecialchars($product['productCode']) ?>">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Tên sản phẩm</label>
                                <input type="text" name="name" class="form-control" required
                                       value="<?= htmlspecialchars($product['productName']) ?>">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Giá bán (VNĐ)</label>
                                <input type="number" name="price" class="form-control" required min="0" step="1000"
                                       value="<?= htmlspecialchars($product['listPrice']) ?>">
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
