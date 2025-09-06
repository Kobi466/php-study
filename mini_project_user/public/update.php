<?php
require_once __DIR__ . '/../src/controller/UserController.php';

$id = $_GET['id'];
if (isset($userModel)) {
    $user = $userModel->getById($id);
}

if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $userNames = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
    $mail = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT);

    $avatarPath = $user['avatar'];
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK){
        $uploadDir = __DIR__ . '/uploads/avatars/';
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/jpg'];
        $fileType = mime_content_type($_FILES['avatar']['tmp_name']);
        if (in_array($fileType, $allowedTypes)) {
            //Delete old avatar
            if($user['avatar'] !== '/uploads/avatars/default.png'&& file_exists(__DIR__ . '/'.$user['avatar'])){
                unlink(__DIR__ . '/'.$user['avatar']);
            }

            //Create new avatar
            $originalFileName = basename($_FILES['avatar']['name']);
            $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
            $newFileName = uniqid('', true).'_'.bin2hex(random_bytes(8)).'.'.strtolower($fileExtension);
            $targetFilePath = $uploadDir.$newFileName;

            if(move_uploaded_file($_FILES['avatar']['tmp_name'], $targetFilePath)){
                $avatarPath = '/uploads/avatars/'.$newFileName;
            }
        }
    }



    $userModel->updateUser($id, $userNames, $mail, $phone, $avatarPath);
    header('Location: index.php');
}

?>

<form method="post" enctype="multipart/form-data">
    <p>Current Avatar:
        <br>
        <img src="<?php htmlspecialchars($user['avatar'])?>" alt="Avatar" width="100">
    </p>
    Name: <input type="text" name="name" value="<?php echo $user['name'] ?>" required>
    Email: <input type="text" name="email" value="<?php echo $user['email'] ?>" required>
    Phone: <input type="text" name="phone" value="<?php echo $user['phone'] ?>" required>
    Avatar: <input type="file" name="avatar" accept="image/*">
    <button type="submit">Update</button>
</form>
