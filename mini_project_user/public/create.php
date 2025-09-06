<?php
global $userModel;
require_once __DIR__ . '/../src/controller/UserController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $userNames = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
    $mail = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT);
    $userModel-> createUser($userNames, $mail, $phone);
    header('Location: index.php');
    exit();
}
?>
<form method="post">
    Name: <input type="text" name="name" required/>
    Email: <input type="text" name="email" required/>
    Phone: <input type="text" name="phone" required/>
    <input type="submit" value="Create" />
</form>
