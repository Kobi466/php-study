<?php
include 'config.php';

$category_id = isset($_GET['category_id']) ? (int)$_GET['category_id'] : 0;

$query = "SELECT p.*, c.categoryName 
          FROM products p 
          JOIN categories c ON p.categoryID = c.categoryID";
$params = [];

if ($category_id > 0) {
    $query .= " WHERE p.categoryID = ?";
    $params[] = $category_id;
}

$query .= " ORDER BY p.productID DESC";

if (!empty($pdo)) {
    $stmt = $pdo->prepare($query);
}
$stmt->execute($params);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Lấy danh sách danh mục
$categories = $pdo->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Quản lý sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3">
                <h4>Danh mục</h4>
                <div class="list-group">
                    <a href="?" class="list-group-item list-group-item-action <?= $category_id == 0 ? 'active' : '' ?>">
                        Tất cả sản phẩm
                    </a>
                    <?php foreach ($categories as $category): ?>
                        <a href="?category_id=<?= $category['categoryID'] ?>" 
                           class="list-group-item list-group-item-action <?= $category_id == $category['categoryID'] ? 'active' : '' ?>">
                            <?= htmlspecialchars($category['categoryName']) ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Nội dung chính -->
            <div class="col-md-9">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2>Danh sách sản phẩm</h2>
                    <a href="add.php" class="btn btn-primary">Thêm sản phẩm</a>
                </div>

                <?php if (empty($products)): ?>
                    <div class="alert alert-info">Không có sản phẩm nào.</div>
                <?php else: ?>
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Mã</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $product): ?>
                                <tr>
                                    <td><?= htmlspecialchars($product['productCode']) ?></td>
                                    <td><?= htmlspecialchars($product['productName']) ?></td>
                                    <td><?= number_format($product['listPrice'], 0, ',', '.') ?> đ</td>
                                    <td>
                                        <a href="edit.php?id=<?= $product['productID'] ?>" class="btn btn-sm btn-warning">Sửa</a>
                                        <a href="delete.php?id=<?= $product['productID'] ?>" 
                                           class="btn btn-sm btn-danger" 
                                           onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
                                            Xóa
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
