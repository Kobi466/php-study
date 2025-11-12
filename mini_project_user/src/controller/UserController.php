<?php
require_once __DIR__ . '/../model/User.php';
require_once __DIR__ . '/../config/db.php';

if (isset($pdo)) {
    $userModel = new User($pdo);
}