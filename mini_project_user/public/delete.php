<?php
require_once __DIR__ . '/../src/controller/UserController.php';
global $userModel;
if (isset($_GET['id']))
{
    $id = $_GET['id'];
    $userModel->deleteUser($id);
}
header('Location: index.php');