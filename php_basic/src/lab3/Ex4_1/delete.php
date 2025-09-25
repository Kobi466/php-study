<?php
session_start();
include 'config.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['error'] = "Invalid product ID.";
    header("Location: list.php");
    exit;
}

$product_id = (int)$_GET['id'];

try {
    if (!empty($pdo)) {
        $stmt = $pdo->prepare("SELECT productName FROM products WHERE productID = ?");
    }
    $stmt->execute([$product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        $_SESSION['error'] = "Product not found.";
        header("Location: list.php");
        exit;
    }
    $stmt = $pdo->prepare("DELETE FROM products WHERE productID = ?");
    $stmt->execute([$product_id]);

    $_SESSION['success'] = "Product '{$product['productName']}' has been deleted successfully.";

} catch (PDOException $e) {
    // Handle any database errors
    $_SESSION['error'] = "An error occurred while deleting the product: " . $e->getMessage();
}

header("Location: list.php");
exit;
?>
