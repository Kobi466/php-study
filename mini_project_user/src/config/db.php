<?php
$host = 'db';
$user = 'user';
$pass = 'userpass';
$db = 'userdb';

try
{
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20)
    );");
//    echo "DB Connected";
}catch (PDOException $e)
{
    die("DB Error".$e->getMessage());
}