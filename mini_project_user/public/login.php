<?php
session_start();
require_once __DIR__ . '/../src/controller/UserController.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST, 'password');
    if (isset($userModel)) {
        $user = $userModel->login($email, $password);
    }
    if ($user){
        $_SESSION['user'] = $user;
        header('Location: index.php');
        exit();
    } else {
        $error = "Invalid username or password";
    }
}
?>
<form method="POST">
    <h1>Login</h1>
    <?php
    if (!empty($error)) echo "<p style='color:red'>$error</p>"
    ?>
    Email: <input type="email" name="email">
    Password: <input type="password" name="password">
    <input type="submit" name="login" value="Login">
</form>
<a href="register.php">Đăng ký</a>

