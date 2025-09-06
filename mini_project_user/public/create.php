<?php
require_once __DIR__ . '/../src/controller/UserController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $userNames = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
    $mail = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT);
    $avatarPath = '/uploads/avatars/default.png';
    //Handling avatar
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK)
    {
        //Noi luu tru avatar
        $uploadDir = __DIR__ . '/uploads/avatars/';
        //Type file
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/jpg'];
        $fileType = mime_content_type($_FILES['avatar']['tmp_name']);

        if (in_array($fileType, $allowedTypes))
        {
            //Tao ten file duy nhat
            $originalFileName = basename($_FILES['avatar']['name']);
            $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
            $newFileName = uniqid('', true) . '_' . bin2hex(random_bytes(8)) . '.' . strtolower($fileExtension);
            $targetFilePath = $uploadDir . $newFileName;
            if (move_uploaded_file($_FILES['avatar']['tmp_name'], $targetFilePath))
            {
                $avatarPath = '/uploads/avatars/' . $newFileName;
            }
        }
    }
    if (isset($userModel)) {
        $userModel-> createUser($userNames, $mail, $phone, $avatarPath);
    }
    header('Location: index.php');
    exit();
}
?>
<form method="post" enctype="multipart/form-data">
    Name: <input type="text" name="name" required/>
    Email: <input type="text" name="email" required/>
    Phone: <input type="text" name="phone" required/>
    Avatar: <input type="file" name="avatar" accept="image/*" />
    <input type="submit" value="Create" />
</form>