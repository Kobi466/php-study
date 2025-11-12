<?php
require_once __DIR__ . '/../src/controller/UserController.php';
if (isset($_GET['id']))
{
    $id = $_GET['id'];
    if (isset($userModel)) {
        $user = $userModel->getById($id);
        if($user && $user['avatar'] !== '/uploads/avatars/default.png'){
            $avatarFilePath = __DIR__ ."/".$user['avatar'];
            if (file_exists($avatarFilePath)){
                unlink( $avatarFilePath);
            }
        }
    }
    if (isset($userModel)) {
        $userModel->deleteUser($id);
    }
}
header('Location: index.php');
exit();