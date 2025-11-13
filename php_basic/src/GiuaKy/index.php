<?php
include_once 'controller/GiangVienController.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'index';

$controller = new GiangVienController();

switch ($action) {
    case 'index':
        $controller->index();
        break;
    case 'add':
        $controller->add();
        break;
    case 'edit':
        $controller->edit();
        break;
    case 'delete':
        $controller->delete();
        break;
    default:
        $controller->index();
        break;
}
?>