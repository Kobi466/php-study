<?php
global $pdo;
require_once __DIR__ . '/../model/User.php';
require_once __DIR__ . '/../config/db.php';

$userModel = new User($pdo);