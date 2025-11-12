<?php
require_once __DIR__ . '/../src/controller/UserController.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
    if (isset($userModel)) {
        $userModel->register($username, $email, $password);
        header('Location: login.php');
        exit();
    }
}
?>
<form method="post">
    <h1>Register</h1>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    UserName: <input type="text" name="username">
    Email: <input type="text" name="email">
    Password: <input type="text" name="password">
    <input type="submit" name="register">
</form>
