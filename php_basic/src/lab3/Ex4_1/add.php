<?php
include 'config.php';

$error_message = '';
$success_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $category_id = $_POST['category_id'];
        $code = trim($_POST['code']);
        $name = trim($_POST['name']);
        $price = (float)$_POST['price'];

        if (empty($code) || empty($name) || $price <= 0) {
            throw new Exception("Please fill in all fields with valid values.");
        }

        if (!empty($pdo)) {
            $stmt = $pdo->prepare("INSERT INTO products (categoryID, productCode, productName, listPrice) VALUES (?, ?, ?, ?)");
        }
        $stmt->execute([$category_id, $code, $name, $price]);

        $success_message = "Product added successfully!";
        
        header("refresh:1;url=list.php");
        
    } catch (Exception $e) {
        $error_message = $e->getMessage();
    }
}
//Option
$categories = $pdo->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Manager - Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .form-container {
            max-width: 600px;
            margin: 40px auto;
            padding: 30px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .form-title {
            color: #333;
            margin-bottom: 25px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        .form-label {
            font-weight: 500;
            margin-bottom: 5px;
        }
        .form-control:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }
        .btn-primary {
            background-color: #0d6efd;
            border: none;
            padding: 8px 20px;
        }
        .btn-outline-secondary {
            padding: 8px 20px;
        }
        .alert {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h3">Product Manager</h1>
                    <a href="list.php" class="btn btn-outline-secondary">View Product List</a>
                </div>
                
                <div class="form-container">
                    <h2 class="h4 form-title">Add Product</h2>
                    
                    <?php if ($error_message): ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($error_message) ?></div>
                    <?php endif; ?>
                    
                    <?php if ($success_message): ?>
                        <div class="alert alert-success">
                            <?= htmlspecialchars($success_message) ?>
                            <div class="spinner-border spinner-border-sm ms-2" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            Redirecting...
                        </div>
                    <?php endif; ?>
                    
                    <form action="add.php" method="post">
                        <div class="mb-3">
                            <label for="category" class="form-label">Category:</label>
                            <select class="form-select" id="category" name="category_id" required>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= $category['categoryID'] ?>">
                                        <?= htmlspecialchars($category['categoryName']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="code" class="form-label">Code:</label>
                            <input type="text" class="form-control" id="code" name="code" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        
                        <div class="mb-4">
                            <label for="price" class="form-label">List Price:</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="price" name="price" 
                                       step="0.01" min="0" required>
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">Add Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
