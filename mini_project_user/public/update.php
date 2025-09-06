<?php
require_once __DIR__ . '/../src/controller/UserController.php';
global $userModel;

$id = $_GET['id'];
$user = $userModel->getById($id);

if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $userNames = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
    $mail = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT);
    $userModel->updateUser($id, $userNames, $mail, $phone);
    header('Location: index.php');
}

?>

<form method="post">
    Name: <input type="text" name="name" value="<?php echo $user['name'] ?>" required>
    Email: <input type="text" name="email" value="<?php echo $user['email'] ?>" required>
    Phone: <input type="text" name="phone" value="<?php echo $user['phone'] ?>" required>
    <button type="submit">Update</button>
</form>
