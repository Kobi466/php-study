<?php

require_once(__DIR__ . '/controller/ProductController.php');

$controller = new ProductController();

$action = $_GET['action'] ?? 'list';

switch ($action) {
    case 'list':
        $controller->getAllProducts();
        break;
    case 'show_add_form':
        $controller->showFormAddProduct();
        break;
    case 'add':
        $controller->addProduct();
        break;
    case 'show_edit_form':
        $controller->showFormEditProduct();
        break;
    case 'update':
        $controller->editProduct();
        break;
    case 'delete':
        $controller->deleteProduct();
        break;
    default:
        $controller->getAllProducts();
        break;
}
?>